let id = (id) => document.getElementById(id)

let emailButton = id('email-button')
let phoneButton = id('phone-button')

let emailDiv = id('email-div')
let phoneDiv = id('phone-div')

let readyButton = id('ready-button')

emailButton.addEventListener('click', () => {
    if (phoneDiv.style.display != 'none') 
        phoneDiv.style.display = 'none'
    
    emailDiv.style.display = 'flex'
    readyButton.style.display = 'inline-block'
})

phoneButton.addEventListener('click', () => {
    if (emailDiv.style.display != 'none') 
        emailDiv.style.display = 'none'
    
    phoneDiv.style.display = 'flex'
    readyButton.style.display = 'inline-block'
})