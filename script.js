let cart=JSON.parse(localStorage.getItem("cart")||"[]");
const menuContainer=document.getElementById("menuItems");
if(menuContainer){
    fetch('get_menu.php').then(res=>res.json()).then(menuData=>{
        menuData.forEach(item=>{
            const div=document.createElement("div");
            div.className="menu-item";
            div.innerHTML=`<img src="${item.img}"><h3>${item.name}</h3><p>₹${item.price}</p>
            <button onclick="addToCart('${item.name}',${item.price})">Add to Cart</button>`;
            menuContainer.appendChild(div);
        });
    });
}

function addToCart(name,price){
    cart.push({name,price});
    localStorage.setItem("cart",JSON.stringify(cart));
    alert("Item added!");
}
