// === SHOW/HIDE PASSWORD ===

const passwordAccess = (loginPass, loginEye) => {
    const input = document.getElementById(loginPass),
        iconEye = document.getElementById(loginEye)

    iconEye.addEventListener('click', () => {
        // Mudar password para text
        input.type === 'password' ? input.type = 'text' : input.type = 'password'
        // Mudar o Icon
        iconEye.classList.toggle('ri-eye-off-fill')
        iconEye.classList.toggle('ri-eye-fill')
    })

}
passwordAccess('password', 'loginPassword')

// === SHOW/HIDE PASSWORD IN CREATE ACCOUNT===

const passwordRegister = (loginPass, loginEye) => {
    const input = document.getElementById(loginPass),
        iconEye = document.getElementById(loginEye)

    iconEye.addEventListener('click', () => {
        // Mudar password para text
        input.type === 'password' ? input.type = 'text' : input.type = 'password'
        // Mudar o Icon
        iconEye.classList.toggle('ri-eye-off-fill')
        iconEye.classList.toggle('ri-eye-fill')
    })

}
passwordRegister('passwordCreate', 'loginPasswordCreate')

// === SHOW/HIDE LOGIN & CREATE ACCOUNT===
const loginAccessRegister = document.getElementById('loginAccessRegister'),
    buttonRegister = document.getElementById('loginButtonRegister'),
    buttonAccess = document.getElementById('loginButtonAccess')

buttonRegister.addEventListener('click', () => {
    loginAccessRegister.classList.add('active')
})

buttonAccess.addEventListener('click', () => {
    loginAccessRegister.classList.remove('active')
})

