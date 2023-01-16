let id = id => document.getElementById(id)

let button = id('create-account')
button.addEventListener('click', createAccount)

async function createAccount() {
    let username = id('username').value

    let response = await fetch('../../PHP/createAccountGoogle.php', {
        method: 'post', 
        body: JSON.stringify({
            username
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    let res = await response.json()

    if (res.ok) {
        location.href = '../Who'
    }
}