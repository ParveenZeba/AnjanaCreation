<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<title>Designer Suits</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">	
<link rel="stylesheet" href="css/custom.css"  type="text/css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
	function LogIn(){
		window.location.href="SignIn.php";
	}
	function Register(){
		window.location.href="Register.php";
	}
</script>	
</head>
	<body>
	<div class="wrapper">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-sm bg-dark text-white justify-content-center">
				<!-- Navbar text-->
			  <span class="navbar-text">
				FREE SHIPPING + COD ON <i class="fas fa-rupee-sign"></i>500 ORDER !
				</span>	
				<div class="button-group d-flex justify-content-end">
					<button type="button" class="btn btn-outline-light" onclick="Register()">Register</button>
				</div>	
			</nav>
		</div>
		<div class="container-fluid">
			<nav class="navbar bg-light text-black ">
				<!--brand/logo-->
				<a class="navbar-brand d-flex justify-content-start" href="#">
					<img src="images/LOGO1.png" alt="logo" style="width:100px;">
				</a>
				<!--brand image-->
				<a class="navbar-brand d-flex justify-content-center" href="#">
					<img src="images/anjana.jpg" alt="Logo" style="width:300px;">
				</a>	
				<!--Links-->
				<ul class="navbar-nav">
					<li class="nav-item">
						<div class="button-group d-flex justify-content-end">
							<button type="button" class="btn btn-outline-dark" onclick="LogIn()">LogIn</button>
							<button type="button" class="btn btn-outline-dark" id="your-cart"><i class="fas fa-cart-arrow-down"></i><span id="item-count" class="badge badge-light">0</span>&nbsp;Items</button>
						</div>	
					</li>
				</ul>
			</nav>
		</div>
		<!--Modal Html-->
		<div id="mymodal" class="modal fade" tableindex="-1">
			<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			
			<!--Modal Header-->
			<div class="modal-header">
				<h4 class="modal-title">Product you select</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="cart-basket">
					<div id="show-cart"></div>
				</div>
				 <div class="cart-total-container d-flex justify-content-around text-capitalize mt-5">
            <h5>total</h5>
            <h5> $ <strong id="total-cart" class="font-weight-bold">0.00</strong> </h5>
          </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="clear-cart">ClearCart</button>
				<button type="button" class="btn btn-secondary">CheckOut</button>
            </div>	
			</div>	
			</div>
		</div>	
		<div class="container-fluid">
			<nav class="navbar navbar-expand-sm bg-dark  sticky-top justify-content-center">
				<ul class="navbar nav">
					<li class="nav-item">
						<a class="nav-link text-white" href="#">Embroided Suits</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#">Printed Suits</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#">ReadyMade Suits</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#">TrackYour Order</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#">Contact Us</a>
					</li>
				</ul>
				<form class="form-inline">
					<input class="form-control mr-sm-2" type="text" placeholder="Search">
					<button class="btn btn-outline-light" type="submit">
						<i class="fas fa-search"></i>
					</button>
				</form>	
			</nav>
		</div>
		<div class="container-fluid bg-light">
			<div class="row">
				<div class="col-sm-4">
					<div class="fabrics card">
						<div class="image-container">
							<img src="images/red.jpg" class="img-fluid fabric" alt="fabrics" >	
						</div>
						<h1>Red Gown</h1>
						<p class="price"><i class="fas fa-rupee-sign"></i>500 </p>
						 <p><button class="add-to-cart" data-name="Red Gown" data-price="500">Add to Cart</button></p>
						
					</div>
				</div>
				<div class="col-sm-4">
					<div class="fabrics card">
						<div class="image-container">
							<img src="images/white.jpg" class="img-fluid fabric" alt="fabrics">
						</div>
						<h1>White Gown</h1>
						<p class="price"><i class="fas fa-rupee-sign"></i>500 </p>
						 <p><button class="add-to-cart" data-name="White Gown" data-price="500" >Add to Cart</button></p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="fabrics card">
					<div class="image-container">
						<img src="images/yellow.jpg" class="img-fluid fabric" alt="fabrics">
					</div>
						<h1>MultiColour Gown</h1>
							<p class="price"><i class="fas fa-rupee-sign"></i>500 </p>
							<p><button class="add-to-cart" data-name="MultiColour Gown" data-price="500">Add to Cart</button></p>
				</div>
			</div>	
			</div>
		</div>	
	</div>
	<script>
		// ***************************************************
// Shopping Cart functions

var shoppingCart = (function () {
    // Private methods and properties
    var cart = [];

    function Item(name, price, count) {
		this.name = name;
        this.price = price;
        this.count = count;
    };
	
	function saveCart(){
		localStorage.setItem("shoppingCart",JSON.stringify(cart));
	};
	
	function loadCart(){
		cart=JSON.parse(localStorage.getItem("shoppingCart"));
		if (cart === null) {
            cart = [];
        }
	};
	loadCart();
	// Public methods and properties
    var obj = {};

    obj.addItemToCart = function (name, price, count) {
        for (var i in cart) {
            if( cart[i].name===name){
                cart[i].count += count;
				saveCart();
                return;
            }
        }

        console.log("addItemToCart:",name, price, count);
		
		alert("Item Added To Cart");

        var item = new Item(name, price, count);
        cart.push(item);
		saveCart();	
    };
	
	obj.setCountForItem=function(name,count){
		for(var i in cart){
			if(cart[i].name===name){
				cart[i].count=count;
				break;
			}
		}
		saveCart();
	};
	
	obj.removeItemFromCart = function (name) { // Removes one item
        for (var i in cart) {
            if(cart[i].name===name) { // "3" === 3 false
                cart[i].count--; // cart[i].count --
                if (cart[i].count === 0) {
                    cart.splice(i, 1);
                }
                break;
            }
        }
        saveCart();
    };
	
	obj.removeItemFromCartAll=function(name){
		for(var i in cart){
			if(cart[i].name===name){
				cart.splice(i,1);
				break;
			}
		}
		saveCart();
	};
	
	obj.clearCart=function(){
		cart=[];
		saveCart();
	};
	obj.countCart=function (){
		var totalCount=0;
		for(var i in cart){
			totalCount+=cart[i].count;
		}
		return totalCount;
	};
	
	obj.totalCart = function () { // -> return total cost
        var totalCost = 0;
        for (var i in cart) {
            totalCost += cart[i].price * cart[i].count;
        }
        return totalCost.toFixed(2);
    };
	
	obj.listCart = function () { // -> array of Items
        var cartCopy = [];
        console.log("Listing cart");
        console.log(cart);
        for (var i in cart) {
            var item = cart[i];
			console.log(i);
            var itemCopy = {};
            for (var p in item) {
                itemCopy[p] = item[p];
				console.log(p);
            }
            itemCopy.total = (item.price * item.count).toFixed(2);
			console.log(itemCopy.total);
            cartCopy.push(itemCopy);
        }
        return cartCopy;
    };
	 // ----------------------------
    return obj;
})();

$(".add-to-cart").click(function(event){
event.preventDefault();
var name = $(this).attr("data-name");
var price = Number($(this).attr("data-price"));
shoppingCart.addItemToCart(name, price, 1);
shoppingCart.listCart();
displayCart();
});
$("#your-cart").click(function(){
$("#mymodal").modal('show');	
});	
$("#clear-cart").click(function(event){
 shoppingCart.clearCart();
displayCart();
});	

	
 
function displayCart() {
				var yourcart=document.getElementById('your-cart');
                var cartArray = shoppingCart.listCart();
                console.log(cartArray);
                var output = "";

                for (var i in cartArray) {
                    output += "<li>" 
                        +cartArray[i].name
                        +" <input class='item-count' type='number' data-name='"
                        +cartArray[i].name+"' value='"+cartArray[i].count+"' style='width:5%;text-align:center;'>"
                       // +" x "
                       // +" = "+cartArray[i].total
                        +" <a class='plus-item' data-name='"
                        +cartArray[i].name+"' href='#'><i class='fas fa-plus'></i></a>"+"&nbsp;"
                        +" <a class='subtract-item' data-name='"
                        +cartArray[i].name+"' href='#'><i class='fas fa-minus'></i></a>"+"&nbsp;"
                        +" <a class='delete-item' data-name='"
                        +cartArray[i].name+"' href='#'><i class='fas fa-trash'></i></a>"+"&nbsp;"+"Price&nbsp;$"
						+cartArray[i].price
                        +"</li>";
                }
				$("#show-cart").html(output);	
				$("#item-count").html(shoppingCart.countCart());
				$("#total-cart").html( shoppingCart.totalCart() );
				
			}
		$("#show-cart").on("click", ".delete-item", function(event){
                var name = $(this).attr("data-name");
                shoppingCart.removeItemFromCartAll(name);
                displayCart();
            });

            $("#show-cart").on("click", ".subtract-item", function(event){
                var name = $(this).attr("data-name");
                shoppingCart.removeItemFromCart(name);
                displayCart();
            });

            $("#show-cart").on("click", ".plus-item", function(event){
                var name = $(this).attr("data-name");
                shoppingCart.addItemToCart(name, 0, 1);
                displayCart();
            });

            $("#show-cart").on("change", ".item-count", function(event){
                var name = $(this).attr("data-name");
                var count = Number($(this).val());
                shoppingCart.setCountForItem(name, count);
                displayCart();
            });
			
            displayCart();

				
			
	</script>


	
	</body>
</html>