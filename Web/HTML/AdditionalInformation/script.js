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

    let data = await response.json()

    console.log(await data)
}