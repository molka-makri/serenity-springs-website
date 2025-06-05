
document.addEventListener("DOMContentLoaded", () => {


    const addForm = document.getElementById("addForm");
    const editForm = document.getElementById("editForm");
    console.log("editForm:", editForm);

        addForm.addEventListener("submit", (event) => {
            // Prevent form submission
            event.preventDefault();
            
            let isValid = true; 
            let errorMessage = ""; 
            const productId = addForm.querySelector("#productId")?.value.trim();
            const productName = addForm.querySelector("#productName")?.value.trim();
            const productDescription = addForm.querySelector("#productDescription")?.value.trim();
            const productPrice = addForm.querySelector("#productPrice")?.value.trim();

            if (!productName || productName.length < 3) {
                errorMessage += "Product Name must be filled with at least 3 characters.\n";
                isValid = false;
            }

            if (!productDescription || productDescription.length < 10) {
                errorMessage += "Product Description must be filled .\n";
                isValid = false;
            }

            if (!productPrice || isNaN(productPrice) || Number(productPrice) <= 0) {
                errorMessage += "Product Price must be filled with a valid positive number.\n";
                isValid = false;
            }
            
           

            if (!isValid) {
                alert(errorMessage); // Show errors in an alert
            } else {
                addForm.submit(); // Submit this specific form if validation passes
            }
        });

        editForm.addEventListener("submit", (event) => {
            event.preventDefault(); // Prevent form submission for validation
    
            let isValid = true;
            let errorMessage = "";
    
            // Fetch and trim input values
            const productId = editForm.querySelector("#editProductId")?.value.trim();
            const productName = editForm.querySelector("#editProductName")?.value.trim();
            const productDescription = editForm.querySelector("#editProductDescription")?.value.trim();
            const productPrice = editForm.querySelector("#editProductPrice")?.value.trim();
            const productCategory = editForm.querySelector("#editProductCategory")?.value.trim();
            const productImage = editForm.querySelector("#editProductImage")?.value.trim();
    
            console.log("Inputs: ", { productId, productName, productDescription, productPrice, productCategory, productImage });
    
            // Validation for Product ID
            if (!productId) {
                errorMessage += "Product ID is required for editing.\n";
                isValid = false;
            }
    
            // Check if at least one field is filled for editing
            const isAnyFieldFilled = productName || productDescription || productPrice || productCategory || productImage;
            if (!isAnyFieldFilled) {
                errorMessage += "At least one field must be updated.\n";
                isValid = false;
            }
            if (!productName || productName.length < 3) {
                errorMessage += "Product Name must be filled with at least 3 characters.\n";
                isValid = false;
            }
            // Validate Product Price if provided
            if (productPrice && (isNaN(productPrice) || Number(productPrice) <= 0)) {
                errorMessage += "Product Price must be a valid positive number if provided.\n";
                isValid = false;
            }
    
            // Validate Product Category if provided
            if (productCategory && isNaN(productCategory)) {
                errorMessage += "Product Category must be a valid number if provided.\n";
                isValid = false;
            }
    
            // If invalid, display error messages
            if (!isValid) {
                alert(errorMessage);
            } else {
                console.log("Validation passed. Submitting the form...");
                editForm.submit(); // Submit if validation passes
            }
        });

    });