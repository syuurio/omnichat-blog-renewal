(() => {
  const paginations = document.querySelectorAll(".custom-pagination");

  const observer = new MutationObserver(([record]) => {
    handlePagination(record.target);
  });

  paginations.forEach((el) => {
    const pagination = el.querySelector(".wp-block-query-pagination-numbers");
    handlePagination(pagination);
    observer.observe(pagination, { subtree: false, childList: true });
  });

  function handlePagination(target) {
    const currentPage = target.querySelector(".current").textContent;
    const totalPages = target.lastChild.textContent;
    target.setAttribute("data-total-pages", totalPages);

    if (currentPage === totalPages) {
      target.classList.add("is-last-page");
    } else {
      target.classList.remove("is-last-page");
    }
  }
})();
