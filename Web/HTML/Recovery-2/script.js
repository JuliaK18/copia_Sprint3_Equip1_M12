let id = id => document.getElementById(id)

id('resetButton').addEventListener('click', async () => {
    let password = id('password').value,
        password_verify = id('password-verify').value,
        hash = id('hash').value

    let response = await fetch('../../PHP/recoverySecond.php', {
        method: 'post', 
        body: JSON.stringify({
            password,
            password_verify, 
            hash
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    let res = await response.json()
    console.log(res)
})