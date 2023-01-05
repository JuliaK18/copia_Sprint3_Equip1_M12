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

    
    // Si la connexió amb el servidor és exitosa
    if (response.ok) {
        // Agafem la resposta del servidor
        let res = await response.json()

        // Si s'ha canviat la contrasenya
        if (res.ok) {
            // Ensenya el modal dient que tot ok
            let modal = new bootstrap.Modal(id('modal'))
            modal.show()

            // Posa un temporitzador per l'animació de confeti
            setTimeout(() => {
                party.confetti(id('party-point'), {
                    count: party.variation.range(50, 60)
                })
            }, 1000);

            // Defineix la barra de progrés
            let progress = id('progress')

            // Definim la variable que farem crèixer per mostrar la barra de progrés
            let current = 0

            // Creem l'interval, cada 5ms executarà el següent
            let interval = setInterval(() => {
                current += 1 
                // Actualitzem l'amplada de la barra de progrés
                progress.style.width = current / 10 + '%'

                // Si hem acabat, elimina l'interval i redirigeix al login
                if (current == 1000) {
                    clearInterval(interval)
                    location.href = '../Login'
                }
            }, 5);
        }
    }
})