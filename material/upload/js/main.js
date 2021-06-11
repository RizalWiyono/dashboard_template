// var mySelect = new BVSelect({
//   selector: "#selectbox",
//   offset: true
// });

document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
    dropZoneElement.querySelector(".dropzone-csv").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
}

// Brandearth

$(window).load(function () {
  $("#be").click(function(){
      $('.hover_bkgr_friccbe').show();
  });
  $('.cnc-csv').click(function(){
      $('.hover_bkgr_friccbe').hide();
  });
  $(".upl-inp").click(function(){
    $('.hover_bkgr_friccbe').hide();
    Swal.fire({
      title: 'Uploading',
      allowEscapeKey: false,
      allowOutsideClick: false,
      background: '#fff',
      showConfirmButton: false,
    });
    Swal.showLoading()
  });
});

$("#btn-be").click(function(){
Swal.fire({
  title: 'Uploading',
  allowEscapeKey: false,
  allowOutsideClick: false,
  background: '#fff',
  showConfirmButton: false,
});
Swal.showLoading()
document.location.href = "process/fetch_envato_be.php";
});

// RRGraph

$(window).load(function () {
  $("#rrg").click(function(){
      $('.hover_bkgr_friccrrg').show();
  });
  $('.cnc-csv').click(function(){
      $('.hover_bkgr_friccrrg').hide();
  });
  $(".upl-inp").click(function(){
    $('.hover_bkgr_friccrrg').hide();
    Swal.fire({
      title: 'Uploading',
      allowEscapeKey: false,
      allowOutsideClick: false,
      background: '#fff',
      showConfirmButton: false,
    });
    Swal.showLoading()
  });
});

$("#btn-rrg").click(function(){
Swal.fire({
  title: 'Uploading',
  allowEscapeKey: false,
  allowOutsideClick: false,
  background: '#fff',
  showConfirmButton: false,
});
Swal.showLoading()
document.location.href = "process/fetch_envato_rrg.php";
});

// TemplateMonster

$(window).load(function () {
  $("#btn-tm").click(function(){
      $('.hover_bkgr_fricctm').show();
  });
  $('.cnc-csv').click(function(){
      $('.hover_bkgr_fricctm').hide();
  });
  $(".upl-inp").click(function(){
    $('.hover_bkgr_fricctm').hide();
    Swal.fire({
      title: 'Uploading',
      allowEscapeKey: false,
      allowOutsideClick: false,
      background: '#fff',
      showConfirmButton: false,
    });
    Swal.showLoading()
  });
});

// CreativeMarket

$(window).load(function () {
  $("#btn-cm").click(function(){
      $('.hover_bkgr_fricccm').show();
  });
  $('.cnc-csv').click(function(){
      $('.hover_bkgr_fricccm').hide();
  });
  $(".upl-inp").click(function(){
    $('.hover_bkgr_fricccm').hide();
    Swal.fire({
      title: 'Uploading',
      allowEscapeKey: false,
      allowOutsideClick: false,
      background: '#fff',
      showConfirmButton: false,
    });
    Swal.showLoading()
  });
});

// RRSlide

$(window).load(function () {
  $("#rrs").click(function(){
      $('.hover_bkgr_friccrrs').show();
  });
  $('.cnc-csv').click(function(){
      $('.hover_bkgr_friccrrs').hide();
  });
  $(".upl-inp").click(function(){
    $('.hover_bkgr_friccrrs').hide();
    Swal.fire({
      title: 'Uploading',
      allowEscapeKey: false,
      allowOutsideClick: false,
      background: '#fff',
      showConfirmButton: false,
    });
    Swal.showLoading()
  });
});

$("#btn-rrs").click(function(){
Swal.fire({
  title: 'Uploading',
  allowEscapeKey: false,
  allowOutsideClick: false,
  background: '#fff',
  showConfirmButton: false,
});
Swal.showLoading()
document.location.href = "process/fetch_rrslide.php";
});

$("#btn-nl").click(function(){
  Swal.fire({
    title: 'Uploading',
    allowEscapeKey: false,
    allowOutsideClick: false,
    background: '#fff',
    showConfirmButton: false,
  });
  Swal.showLoading()
  document.location.href = "process/fetch_sendingblue.php";
});

$("#btn-dp").click(function(){
  Swal.fire({
    title: 'Uploading',
    allowEscapeKey: false,
    allowOutsideClick: false,
    background: '#fff',
    showConfirmButton: false,
  });
  Swal.showLoading()
  document.location.href = "process/fetch_popular.php";
});

