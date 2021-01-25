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


