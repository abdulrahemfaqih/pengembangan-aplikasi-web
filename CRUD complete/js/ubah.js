const form = document.querySelector("form");
const nimInput = document.getElementById("nim");
const namaInput = document.getElementById("nama");
const emailInput = document.getElementById("email");
const jurusanInput = document.getElementById("jurusan");
const submitButton = document.querySelector("button");

form.addEventListener("submit", function (event) {
  if (
    nimInput.value === "" ||
    namaInput.value === "" ||
    emailInput.value === "" ||
    jurusanInput.value === ""
  ) {
    alert("semua inputan harus diisi");
    event.preventDefault();
  }
});


function imagePreview() {
  const image = document.getElementById("gambar");
  const imgPreview = document.querySelector(".imgPreview");

  const ofReader = new FileReader();
  ofReader.readAsDataURL(image.files[0]);

  ofReader.onload = (oFREvent) => {
    imgPreview.src = oFREvent.target.result;
  };
}