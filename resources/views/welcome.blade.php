<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Does my friends face look somewhat pear shaped?</title>
</head>

<style>
    body {
        padding: 1rem;
    }
    img { width: 400px; max-width: 100%;}
    h1 { margin: 0 auto; width: fit-content; text-align: center; padding-bottom: 1rem;}
    button { min-width: 100px; padding: .5rem 1rem; font-size: 1.5rem}
    .voting-section {
        display: flex;
        /* flex-direction: column; */
        justify-content: center;
        align-items: center;

    }

    .vote-count {
        font-size: 1.5rem;
    }

    .voting-div {
        display: flex;
        /* flex-direction: column; */
        text-align: center;
        gap: 2rem;
        justify-content: center;
        align-items: center;
    }

    @media only screen and (max-width: 600px) {
        .voting-section {
            flex-direction: column;
        }

        img {
            max-width: 70%;
        }
    } 
</style>
<body>
        
    <h1>Does my friends face look somewhat pear shaped? test</h1>
    <section class="voting-section" aria-label="">
        
        <div class="image-div">
            <img src="{{ asset('images/mj.jpg') }}" alt="Image 1" aria-label="my friend wearing glasses and a hawaiin shirt with an oddly pear shaped face">
        </div>
        
        <div class="image-div">
            <img src="{{ asset('images/pear.jpg') }}" alt="Image 2" aria-label="a pear">
        </div>
        
    </section>
    
    <section class="voting-div" aria-label="vote on the question of if my friends face is pear shaped or not - I mean you should probably just vote yes, I wouldn't go out of my way to build an entire website if it wasn't">
        
        <div>
            <p class="vote-count">"No" Votes: <span id="votes-B">{{ $optionB ? $optionB->vote_count : 0 }}</span></p>
            <button onclick="vote('Option B')">No</button>
        </div>

        <div>
            <p class="vote-count">"Yes" Votes: <span id="votes-A">{{ $optionA ? $optionA->vote_count : 0 }}</span></p>
            <button onclick="vote('Option A')">Yes</button>
        </div>

        
        
    </section>
    <p id="thank-you" style="text-align: center; font-size: 1.25rem; margin-top: 1rem; display: none;">
        Thanks for voting!
    </p>    


    <script>
        const hasVoted = sessionStorage.getItem('hasVoted');
        
        if (hasVoted) {
            hideVoteButtons();
            showThankYou();
        }
    
        function vote(option) {
            fetch(`/vote/${option}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                console.log('data:', data);  // Add this for debugging
                if (data.vote_count !== undefined) {
                    document.getElementById(`votes-${option === 'Option A' ? 'A' : 'B'}`).innerText = data.vote_count;
                    sessionStorage.setItem('hasVoted', true);
                    hideVoteButtons();
                    showThankYou();
                } else {
                    showError('There was an error updating the vote count.');
                }
            })
            .catch(error => {
                showError('There was an error with the network request.');
            });
        }
    
        function hideVoteButtons() {
            document.querySelectorAll('button').forEach(btn => btn.style.display = 'none');
        }
    
        function showThankYou() {
            document.getElementById('thank-you').style.display = 'block';
        }
    
        function showError(message) {
            const errorMessage = document.createElement('p');
            errorMessage.style.color = 'red';
            errorMessage.style.fontSize = '1.25rem';
            errorMessage.style.textAlign = 'center';
            errorMessage.style.marginTop = '1rem';
            errorMessage.textContent = message;
    
            document.body.appendChild(errorMessage);
        }
    </script>
    
    
    
</body>
</html>
