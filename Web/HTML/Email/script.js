let id = id => document.getElementById(id)

let btn = id('registerButton')
let form = id('registerForm')

let username = id()

btn.addEventListener('click', (e) => {
    e.preventDefault()
    register()

})

async function register() {
    let username = id('usernameInput').value
    let email = id('emailInput').value
    let password = id('passwordInput').value
    let passwordRepeat = id('passwordRepeatInput').value

    let response = await fetch('../../PHP/createAccountNormal.php', {
        method: 'POST',
        body: JSON.stringify({
            username,
            email, 
            password,
            passwordRepeat
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    if (response.ok) {
        let data = await response.json()
        console.log(data)
    } else {
        console.log('error')
    }
}