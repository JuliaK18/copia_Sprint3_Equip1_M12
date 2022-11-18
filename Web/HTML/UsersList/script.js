let id = id => document.getElementById(id)

const successToast = new bootstrap.Toast(id('successToast'))
const errorToast = new bootstrap.Toast(id('errorToast'))

async function accept(userID) {
    let response = await fetch('../../PHP/accept.php', {
        method: 'post', 
        body: JSON.stringify({
            userID
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    let data = await response.json()
    
    if (data.ok) {
        sessionStorage.setItem('showToast', 'success')
        location.reload()
    } else {
        errorToast.show()
    }
}

async function discard(userID) {
    let response = await fetch('../../PHP/discard.php', {
        method: 'post', 
        body: JSON.stringify({
            userID
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    let data = await response.json()
    
    if (data.ok) {
        sessionStorage.setItem('showToast', 'discarted')
        location.reload()
    } else {
        errorToast.show()
    }
}

window.onload = () => {
    let showToast = sessionStorage.getItem('showToast')
    if (showToast == 'success') {
        sessionStorage.removeItem('showToast')
        id('successToastMessage').innerText = 'User verificated'
        successToast.show()
    } else if (showToast == 'discarted') {
        sessionStorage.removeItem('showToast')
        id('successToastMessage').innerText = 'User discarded'
        successToast.show()
    }
}