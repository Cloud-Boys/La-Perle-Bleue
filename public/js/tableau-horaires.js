function confirmDelete()
{
    let event = window.event
    event.preventDefault()
    const modal = document.querySelector("#modal")
    modal.style.display = "block"


    modal.querySelector("#modal-actions__cancel").addEventListener("click", () => {
        modal.style.display = "none"
    })
}