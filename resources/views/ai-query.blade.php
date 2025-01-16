<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KW AI Agent</title>
</head>
<body>
    <h1>Kaykewalk AI Agent</h1>
    <form id="aiQueryForm" method="POST" action="/ai/query">
        @csrf
        <input type="text" name="query" placeholder="Enter your query" required>
        <button type="submit" id="submit-btn">Submit</button>
    </form>
    <pre id="response"></pre>

    @if(isset($response))
        <div>
            {{ $response['text'] }}
        </div>
    @endif


    <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.1/annyang.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/SpeechKITT/0.3.0/speechkitt.min.js"></script>

    <script>

    let voices = [];

    function preloadVoices() {
        voices = window.speechSynthesis.getVoices();
        if (voices.length === 0) {
            window.speechSynthesis.onvoiceschanged = () => {
                voices = window.speechSynthesis.getVoices();
            };
        }
    }

    // Preload voices on page load
    preloadVoices();

       
        document.getElementById('aiQueryForm').addEventListener('submit', async function (event) {
            event.preventDefault();
            speakRes('Please wait while I process your query...');
            // stop annyang

            annyang.abort();

            // speakRes('Please wait while I process your query...');

            const query = event.target.query.value;

            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/ai/query', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to headers
                    },
                    body: JSON.stringify({ query }),
                });

                const data = await response.json();
                document.getElementById('response').textContent = data.text;
                speakRes(data.text);
                document.getElementById('aiQueryForm').reset();
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('response').textContent = 'An error occurred. Check the console for details.';
            }
        });

        function speakRes(res) {
            if (!res || res.trim() === "") {
                console.error("No text provided for speech synthesis.");
                return;
            }
            const msg = new SpeechSynthesisUtterance();
            msg.text = res;
            msg.volume = 1; // Volume (0 to 1)
            msg.rate = 0.8; // Speed (0.1 to 10)
            msg.pitch = 1; // Pitch (0 to 2)
            msg.lang = 'en-US';
            console.log("Voices:", voices);
            // Assign a voice
            msg.voice = voices.find(voice => voice.lang === 'en-US') || voices[0];

            // Retry if voices are not ready
            if (!msg.voice) {
                console.error("Voices are not ready. Retrying...");
                preloadVoices();
                setTimeout(() => speakRes(res), 500); // Retry after a short delay
                return;
            }

            msg.onend = function(event) {
                console.log('Speech finished in ' + event.elapsedTime + ' seconds.');
            };

            console.log("Speaking:", res);

            speechSynthesis.speak(msg);
        }


        if (annyang) {
            var commands = {
                'kk *query': function(query) {
                    document.getElementById('aiQueryForm').query.value = query;
                    let submitBtn = document.getElementById('submit-btn');
                    submitBtn.click();
                }
            };

            annyang.setLanguage('en-IN');
            annyang.addCommands(commands);
            SpeechKITT.annyang();
            SpeechKITT.setStylesheet('//cdnjs.cloudflare.com/ajax/libs/SpeechKITT/0.3.0/themes/flat.css');
            SpeechKITT.vroom();
        }

    </script>
</body>
</html>
