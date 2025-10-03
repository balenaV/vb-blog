// === SHOW/HIDE PASSWORD ===

const passwordAccess = (loginPass, loginEye) => {
    const input = document.getElementById(loginPass),
        iconEye = document.getElementById(loginEye)

    iconEye.addEventListener('click', () => {
        // Mudar password para text
        input.type === 'password' ? input.type = 'text' : input.type = 'password'
        // Mudar o Icon
        iconEye.classList.toggle('fa-eye-slash')
        iconEye.classList.toggle('fa-eye')
    })

}
passwordAccess('password', 'loginPassword')