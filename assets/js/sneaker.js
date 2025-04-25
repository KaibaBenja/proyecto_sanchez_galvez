let prevBtn = document.getElementById("prev");
let nextBtn = document.getElementById("next");
let carousel = document.querySelector(".carousel");
let items = carousel.querySelectorAll(".list .item");
let indicator = carousel.querySelector(".indicators");
let dots = indicators.querySelectorAll("ul li");
let active = 2;
let firstPosition = 0;
let lastPosition = items.length - 1;

const setSlider = () => {
  let itemActiveOld = carousel.querySelector(".list .item.active");
  if (itemActiveOld) {
    itemActiveOld.classList.remove("active");
  }
  items[active].classList.add("active");

  let dotActiveOld = indicators.querySelector("li.active");
  if (dotActiveOld) {
    dotActiveOld.classList.remove("active");
  }
  dots[active].classList.add("active");
  indicator.querySelector(".number").innerText = active + 1;
};
