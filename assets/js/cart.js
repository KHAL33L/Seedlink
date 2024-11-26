document.addEventListener("DOMContentLoaded", () => {
    const cartTableBody = document.getElementById("cartTableBody");

    // Initialize cart from localStorage
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Render the cart table
    const renderCartTable = () => {
        cartTableBody.innerHTML = ""; // Clear existing rows

        if (cart.length === 0) {
            const emptyRow = document.createElement("tr");
            emptyRow.innerHTML = `
                <td colspan="5" style="text-align: center;">Your cart is empty.</td>
            `;
            cartTableBody.appendChild(emptyRow);
            return;
        }

        cart.forEach((item, index) => {
            const row = document.createElement("tr");

            const totalPrice = (item.price * item.quantity).toFixed(2);

            row.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price}</td>
                <td>
                    <input type="number" value="${item.quantity}" min="1" data-index="${index}" class="quantity-input">
                </td>
                <td>$${totalPrice}</td>
                <td>
                    <button class="remove-btn" data-index="${index}">Remove</button>
                </td>
            `;

            cartTableBody.appendChild(row);
        });

        addCartEventListeners();
    };

    // Add event listeners for quantity changes and remove buttons
    const addCartEventListeners = () => {
        // Handle quantity changes
        document.querySelectorAll(".quantity-input").forEach((input) => {
            input.addEventListener("change", (e) => {
                const index = e.target.dataset.index;
                const newQuantity = parseInt(e.target.value);

                if (newQuantity > 0) {
                    cart[index].quantity = newQuantity;
                    localStorage.setItem("cart", JSON.stringify(cart)); // Save updated cart
                    renderCartTable(); // Re-render table
                }
            });
        });

        // Handle item removal
        document.querySelectorAll(".remove-btn").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const index = e.target.dataset.index;
                cart.splice(index, 1);
                localStorage.setItem("cart", JSON.stringify(cart)); // Save updated cart
                renderCartTable(); // Re-render table
            });
        });
    };

    // Render the cart on page load
    renderCartTable();
});
