// menu items and prices
const menu = {
    "burger": 100,
    "fries": 70,
    "salad": 50,
    "soft-drink": 20,
    "coffee": 30
  };
// adding items
  function addItem(item)
   {
    // Get the bill items list and create a new list item
    let billItems = document.getElementById("bill-items");
    let newItem = document.createElement("li");
    
    // Setting text content ofnew list item to item name and price
    newItem.textContent = `${item.charAt(0).toUpperCase() + item.slice(1)} (Rs.${menu[item].toFixed(2)})`;
    // Adding a remove button
    let removeButton = document.createElement("button");
    removeButton.textContent = "Remove";
    removeButton.addEventListener("click", function() {
      billItems.removeChild(newItem);
      // update bill upon removing items
      updateBill();  
    });
    newItem.appendChild(removeButton);
    
    // Add new item to bill list
    billItems.appendChild(newItem);
    
    // Update bill
    updateBill();
  }
  // bill updating
  function updateBill() 
  {
    let billItems = document.getElementById("bill-items");
    let subtotalSpan = document.getElementById("subtotal");
    let taxSpan = document.getElementById("tax");
    let totalSpan = document.getElementById("total");
    // Calculate subtotal and update
    let subtotal = 0;
    for (let i = 0; i < billItems.children.length; i++) {
      let itemPrice = parseFloat(billItems.children[i].textContent.split("Rs.")[1]);
      subtotal += itemPrice;
    }
    subtotalSpan.textContent = subtotal.toFixed(2);
    
    // Calculate tax and update
    let tax = subtotal * 0.1;
    taxSpan.textContent = tax.toFixed(2);
    
    // Calculate the total update
    let total = subtotal + tax;
    totalSpan.textContent = total.toFixed(2);
  }
  
  //clearing bill
  function clearBill() {
    // Get bill items list and remove all items
    let billItems = document.getElementById("bill-items");
    while (billItems.firstChild) {
      billItems.removeChild(billItems.firstChild);
    }
    // Update the bill
    updateBill();
  }   
  document.getElementById("burger").addEventListener("click", function() { addItem("burger"); });
  document.getElementById("fries").addEventListener("click", function() { addItem("fries"); });
  document.getElementById("salad").addEventListener("click", function() { addItem("salad"); });
  document.getElementById("soft-drink").addEventListener("click", function() { addItem("soft-drink"); });
  document.getElementById("coffee").addEventListener("click", function() { addItem("coffee"); });
  document.getElementById("clear-bill").addEventListener("click", clearBill);
  