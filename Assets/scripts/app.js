const openReplyBtns = document.querySelectorAll(".reply_btn");
const addReplyForms = document.querySelectorAll(".add_reply_form");

function changeReplyButtonText(button) {
  if (button.textContent === "Close reply") {
    button.textContent = "Reply";
  }
  else {
    button.textContent = "Close reply";
  }
}

function displayReplyForm(button, form) {
  if (button.dataset.id === form.dataset.id) {
    form.classList.toggle("show_reply_form");
    changeReplyButtonText(button);

  }
}

openReplyBtns.forEach((openReplyBtn) => {
  openReplyBtn.addEventListener("click", () => {
    addReplyForms.forEach((addReplyForm) => {
      displayReplyForm(openReplyBtn, addReplyForm);

    })
  })
})



const deleteAccountBtn = document.querySelector('.delete_account');
const deleteAccountForm = document.querySelector('.delete_form');

if(deleteAccountBtn){
  deleteAccountBtn.addEventListener("click", () => {
  const confirmed = window.confirm('Are you sure you want to delete your Hacker News account permanently?');

  if(confirmed){
    deleteAccountForm.action = "web/user/deleteAccount.php";
  }
  else{
    deleteAccountForm.action = "settings.php";
  }
})
}

