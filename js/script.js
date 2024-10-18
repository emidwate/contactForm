const form = document.querySelector(".contact-form")

form.addEventListener("submit", (e) => {
    
    e.preventDefault()

    const emailError = document.querySelector(".email-error")
    const phoneError = document.querySelector(".phone-error")
    const email = form.elements['email'].value
    const phoneNumber = Number(form.elements['phone-number'].value)

    if (!emailIsValid(email)) {
        emailError.textContent = "Podaj poprawny adres email"
        return;
    } else {
        emailError.textContent = ""
    }

    if(!phoneNumberValid(phoneNumber)) {
        phoneError.textContent = "Podaj poprawny numer telefonu"
        return;
    } else {
        phoneError.textContent = ""
    }

    form.submit()
})

function emailIsValid(email) {
    return /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/.test(email)
}

function phoneNumberValid(phoneNumber) {
    return /^([0-9]{4,12})/.test(phoneNumber)
}