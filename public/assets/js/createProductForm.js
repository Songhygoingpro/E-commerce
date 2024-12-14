document.addEventListener("DOMContentLoaded", () => {
  const saveBtn = document.querySelector(".save-button"); // Save button
  const inputFields = document.querySelectorAll("input"); // All input fields

  // Initially disable the button
  saveBtn.setAttribute("disabled", "true");
  saveBtn.classList.add("bg-gray-600", "cursor-not-allowed"); // Styling for disabled button

  // Add event listeners to all input fields
  inputFields.forEach((field) => {
    field.addEventListener("input", () => {
      // Check if at least one input field is non-empty
      const atLeastOneFilled = Array.from(inputFields).some((input) => input.value.trim() !== "");

      if (atLeastOneFilled) {
        saveBtn.removeAttribute("disabled");
        saveBtn.classList.remove("bg-gray-600", "cursor-not-allowed");
        saveBtn.classList.add("bg-black"); // Active button styling
      } else {
        saveBtn.setAttribute("disabled", "true");
        saveBtn.classList.remove("bg-black");
        saveBtn.classList.add("bg-gray-600", "cursor-not-allowed"); // Disabled button styling
      }
    });
  });

  const imgUploadButton = document.getElementById("img-upload-button");
  const imagePreview = document.getElementById("image-preview");
  const uploadedImage = document.getElementById("uploaded-image");
  const loader = document.getElementById("loader");
  const fileInput = document.getElementById("file-input");
  const changeImageButton = document.getElementById("change-image-button");
  const removeImageButton = document.getElementById("remove-image-button");

  // Listen for file input changes
  fileInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    if (file) {
      // Hide the upload button and show the loader
      imgUploadButton.classList.add("hidden");
      loader.classList.remove("hidden");
      imagePreview.classList.remove("hidden");

      // Load the image
      reader.onload = function (e) {
        // Set the uploaded image src
        uploadedImage.src = e.target.result;

        // Hide the loader
        loader.classList.add("hidden");
      };

      // Read the file as a data URL
      reader.readAsDataURL(file);
    }
  });

  // Handle "Change" button click
  changeImageButton.addEventListener("click", function () {
    fileInput.value = ""; // Clear the file input
    fileInput.click(); // Trigger the file input click event
  });

  // Handle "Remove" button click
  removeImageButton.addEventListener("click", function () {
    uploadedImage.src = ""; // Clear the image source
    fileInput.value = ""; // Clear the file input

    // Hide the image preview and show the upload button
    imagePreview.classList.add("hidden");
    imgUploadButton.classList.remove("hidden");
  });

  // Calculate Profit and Margin for each Product
  const productPrice = document.getElementById('product-price')
  const productCost = document.getElementById("product-cost");
  const productProfit = document.getElementById("product-profit");
  const productMargin = document.getElementById("product-margin");

  productCost.addEventListener("input", () => {
productProfit.value =  productPrice.value - productCost.value;
productMargin.value = productProfit.value * 100 / productPrice.value + "%";
productProfit.value = "$" + productProfit.value;
  });
});
