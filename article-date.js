(() => {
  const elements = document.querySelectorAll(".article-date time");

  elements.forEach((el) => {
    const date = el.getAttribute("datetime");
    const formattedDate = new Intl.DateTimeFormat("en-US", {
      year: "numeric",
      month: "long",
      day: "numeric",
    }).format(new Date(date));

    el.textContent = formattedDate;
  });
})();
