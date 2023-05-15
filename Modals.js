const deleteButton = document.getElementsByClassName('delete-button')[0];
const deleteModal = document.querySelector('#id01');

deleteButton.addEventListener('click', (event) => {
    event.preventDefault();
    deleteModal.style.display = 'block';
}
);