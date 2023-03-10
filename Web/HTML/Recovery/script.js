let id = id => document.getElementById(id)

let changePasswordButton = id('change-password')

changePasswordButton.addEventListener('click', async () => {
    let email = id('email').value
    let response = await fetch('../../PHP/recovery.php', {
        method: 'post', 
        body: JSON.stringify({
            email
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    id('message-on-send').style.display = 'inline-block'
})
