<form action="{{ route('admin.slack.save-channel') }}" method="POST">
    @csrf
    <label for="channel">Select Slack Channel:</label>
    <select name="channel_id" id="channel">
        @foreach ($channels as $channel)
            <option value="{{ $channel['id'] }}">{{ $channel['name'] }}</option>
        @endforeach
    </select>
    <button type="submit">Save Channel</button>
</form>
