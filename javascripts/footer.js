document.querySelector(".back-to-top").addEventListener("click", function (e) {
  e.preventDefault();
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

document
  .querySelector(".newsletter-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const email = this.querySelector(".newsletter-input").value;
    if (email) {
      alert(`Thank you for subscribing with: ${email}`);
      this.querySelector(".newsletter-input").value = "";
    }
  });
