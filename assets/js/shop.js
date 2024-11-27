


document.addEventListener("DOMContentLoaded", () => {
    //Panel and card control
    const seedsBtn = document.getElementById("seeds-btn");
    const saplingsBtn = document.getElementById("saplings-btn");
    const seedsCard = document.getElementById("seeds-card");
    const saplingsCard = document.getElementById("saplings-card");
    const slider = document.getElementById("filter-slider");
    const sliderValue = document.getElementById("sliderValue");

    //Products control
    const productGrid = document.getElementById("productGrid");
    const productModal = document.getElementById("productModal");
    const closeModal = document.getElementById("closeModal");

    const modalProductImage = document.getElementById("modalProductImage");
    const modalProductName = document.getElementById("modalProductName");
    const modalProductDescription = document.getElementById("modalProductDescription");
    const modalProductPrice = document.getElementById("modalProductPrice");
    const modalAddToCart = document.getElementById("modalAddToCart");
    const sellerPhone = document.getElementById("sellerPhone");


    let currentProductId = null;


        // Slider value display
    slider.addEventListener("input", () => {
        sliderValue.textContent = slider.value;
    });
    
        // Show Seeds Card
        seedsBtn.addEventListener("click", () => {
            seedsCard.classList.add("active");
            saplingsCard.classList.remove("active");
        });
    
        // Show Saplings Card
        saplingsBtn.addEventListener("click", () => {
            saplingsCard.classList.add("active");
            seedsCard.classList.remove("active");
        });

    // Fetch products by category
    const fetchProducts = async () => {
        try {
            const response = await fetch("../actions/getproducts_seeds.php?category=seed");
            const products = await response.json();

            if (products.error) {
                console.error(products.error);
                return;
            }

            displayProducts(products);
        } catch (error) {
            console.error("Error fetching products:", error);
        }
    };

        // Fetching and displaying products based on slider price selector
    const fetchFilteredProducts = async (maxPrice) => {
        try {
            const response = await fetch("../actions/filter_products.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `maxPrice=${maxPrice}`,
            });
    
            const products = await response.json();
    
            if (products.error) {
                console.error(products.error);
                productGrid.innerHTML = "<p>Error fetching products.</p>";
                return;
            }
    
            displayProducts(products);
            } catch (error) {
                console.error("Error:", error);
                productGrid.innerHTML = "<p>Error fetching products.</p>";
            }
        };



    // Display products in cards
    const displayProducts = (products) => {
        productGrid.innerHTML = ""; // Clear the grid

        products.forEach((product) => {
            const productCard = document.createElement("div");
            productCard.className = "product-card";
            productCard.innerHTML = `
                <img src="${product.image_url}" alt="${product.name}" class="product-image">
                <h3>${product.name}</h3>
                <p>GH₵${product.price}</p>
                <button class="add-to-cart-btn" data-product-id="${product.product_id}">Add to Cart</button>
            `;

            // Add click event to the card for showing modal
            productCard.addEventListener("click", () => {
                currentProductId = product.product_id;
                showModal(product);
            });

            productGrid.appendChild(productCard);
        });
    };

    // Show modal with product details
    const showModal = (product) => {
        modalProductImage.src = product.image_url;
        modalProductName.textContent = product.name;
        modalProductDescription.textContent = product.description || "No description available.";
        modalProductPrice.textContent = product.price;
        productModal.style.display = "flex";
    };

    // Close modal
    closeModal.addEventListener("click", () => {
        productModal.style.display = "none";
    });

    const fetchSellerPhone = async (productId) => {
        try {
            const response = await fetch(`../../actions/get_seller.php?product_id=${productId}`);
            const data = await response.json();

            if (data.success) {
                sellerPhone.textContent = data.number; // Update the modal with the phone number
            } else {
                sellerPhone.textContent = "No phone number available.";
            }
        } catch (error) {
            console.error("Error fetching seller phone:", error);
            sellerPhone.textContent = "Error fetching phone number.";
        }
    };

    const openModal = (productId) => {
        // Reset modal content
        sellerPhone.textContent = "Loading...";
    
        // Fetch seller's phone number
        fetchSellerPhone(productId);
    
        // Display the modal
        productModal.style.display = "block";
    };
    

    // Fetch and display products on page load
    fetchProducts();
    fetchFilteredProducts()

    
});
