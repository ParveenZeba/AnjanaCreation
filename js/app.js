//show cart
(function(){
	const cartinfo=document.getElementById('cart-info');
	const cart=document.getElementById('cart');
	cartinfo.addEventListener("click",function(){
		cart.classList.toggle("show-cart");
	});
})();
//add item
(function(){
	const cartBtn=document.querySelectorAll('.store-item-icon');
	cartBtn.forEach(function(btn){
		btn.addEventListener('click',function(event){
			//console.log(event.target);
		if(event.target.parentElement.classList.contains("store-item-icon")){
			//console.log(event.target.parentElement.parentElement);
			//console.log(event.target.parentElement.previousElementSibling);
			let fullPath=event.target.parentElement.previousElementSibling.src;
			let pos=fullPath.indexOf("img")+3; //it shows the position of img
			let partPath=fullPath.slice(pos); //it shows only the name of image
			//console.log(partPath); 
			const item={};
			item.img=`img-cart${partPath}`;
			let name=event.target.parentElement.parentElement.nextElementSibling.children[0].children[0].textContent;
			let price=event.target.parentElement.parentElement.nextElementSibling.children[0].children[1].textContent;
			let finalPrice=price.slice(1).trim();
			//console.log(name);
			//console.log(finalPrice);
			item.name=name;
			item.price=finalPrice;
			console.log(item);
			const cartItem=document.createElement('div');
			cartItem.className="cart-item d-flex justify-content-between text-capitalize my-3";
			
			//Template literal for multiple line uses backtick
			
			cartItem.innerHTML= `
				<img src="${item.img}" class="img-fluid rounded-circle" id="item-img" alt="" width="50" height="50">
				<div class="item-text">

				  <p id="cart-item-title" class="font-weight-bold mb-0">${item.name}</p>
				  <span>$</span>
				  <span id="cart-item-price" class="cart-item-price" class="mb-0">${item.price}</span>
				</div>
				<a href="#" id='cart-item-remove' class="cart-item-remove">
				  <i class="fas fa-trash"></i>
				</a>`;
			
		  //select element
		 const cart=document.getElementById("cart");
		  const total=document.querySelector('.cart-total-container');
		 // console.log(total);
		  cart.insertBefore(cartItem,total);
		  alert("item added to the cart");
		  showTotals();
	  //remove element
		 document.getElementById('clear-cart').addEventListener("click",function(event){ 
		deleteitem(name);});
		}	
		});
	});
	
	function showTotals()
	{
		const total=[];
		const items=document.querySelectorAll('.cart-item-price');
		items.forEach(function(item){
			total.push(parseFloat(item.textContent));
		});
		//console.log(total);
		const totalMoney=total.reduce(function(total,item){
			total+=item;
			return total;
		}
		);
		
		//console.log(total);
		//console.log(totalMoney);
		const finalMoney=totalMoney.toFixed(2);
		document.getElementById("cart-total").textContent=finalMoney;
		document.querySelector('.item-total').textContent=finalMoney;
		document.getElementById('item-count').textContent=total.length;
	}
	//function for delete item
	function deleteitem(name){
		 let i =document.getElementById('clear-cart');
		for(let i in cart){
				if(cart[i].name===name){
					cart[i].splice(i,1);
					break;
					
				}
			}
		}
		
		deleteitem(cart);
		console.log(cart);
		
		
		
	})();