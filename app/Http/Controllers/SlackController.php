<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SlackController extends Controller
{
    public function redirectToSlack()
    {
        $clientId = env('SLACK_CLIENT_ID');
        $redirectUri = env('SLACK_REDIRECT_URI');
        $scopes = 'channels:read,chat:write';
        
        $url = "https://slack.com/oauth/v2/authorize?client_id={$clientId}&scope={$scopes}&redirect_uri={$redirectUri}";

        return redirect($url);
    }

    public function handleSlackCallback(Request $request)
    {
        $code = $request->get('code');
        $clientId = env('SLACK_CLIENT_ID');
        $clientSecret = env('SLACK_CLIENT_SECRET');
        $redirectUri = route('admin.slack.callback');
        
        // Exchange authorization code for an access token
        $response = Http::asForm()->post('https://slack.com/api/oauth.v2.access', [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'code' => $code,
            'redirect_uri' => $redirectUri,
        ]);

        $data = $response->json();
        if (isset($data['access_token'])) {
            
            $org = Organization::find(session('org_id'));

            $org->slack_access_token = $data['access_token'];
            $org->slack_team_id = $data['team']['id'];

            $org->save();
            
            return redirect()->route('admin.slack.channels');
        } else {
            return redirect()->back()->with('error', 'Failed to connect to Slack');
        }
    }

    public function listChannels()
    {
        $org = Organization::find(session('org_id'));
        $response = Http::withToken($org->slack_access_token)->get('https://slack.com/api/conversations.list', [
            'types' => 'public_channel,private_channel',
        ]);

        $channels = $response->json()['channels'];

        return view('select-slack-channel', compact('channels'));
    }

    public function saveChannel(Request $request)
    {
        $org = Organization::find(session('org_id'));
        $org->slack_channel_id = $request->input('channel_id');
        $org->save();

        return redirect()->route('organization.profile')->with('success', 'Slack integration has been successfully set up.');
    }

    public function sendMessage()
    {
        $org = Organization::find(session('org_id'));
        $slackAccessToken = $org->slack_access_token;
        $slackChannelId = $org->slack_channel_id;

        $message = "Task has been completed.";

        // Send the message to Slack
        Http::withToken($slackAccessToken)->post('https://slack.com/api/chat.postMessage', [
            'channel' => $slackChannelId,
            'text' => $message,
        ]);
    }
}
