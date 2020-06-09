<?php
       require('../src/config.php');
       require('../src/dbconnect.php');

         //$products = fetchAllProducts();

    
?>

        
      <?php 
      include('layout/header.php');
      include('cart.php');


      ?>

    <nav>
          <ul>
            
            <li><a href="products.php">CONTINUE SHOPPING</a></li>
          </ul>
      </nav>

  <div class="container-fluid">
    <div class="row">

        <div class="col-12">
                <table class="table table-dark" style="width:100%">
                  <thead>
                      <tr>
                          <th>Product</th>
                          <th>Info</th>
                          <th></th>
                          <th>Antal</th>
                          <th>Pris per produkt</th>
                        </tr>
                    </thead>    
                      <tbody id="ProdList">
                          <?php 
                
                             foreach($_SESSION['cartItems'] as $cartId => $cartItem){ ?>
                                
                                      <tr>
                                      
                                        <td><img src="XXXX"></td>
                                        <td><?=$cartItem['description']?></td>
                                        <td>
                                          <form action="delete-cart-item.php" method="POST"> 
                                            <input type="hidden" name="cartId" value="<?=$cartId?>">
                                             <button type="submit" class="btn">
                                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="    currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                          </form>
                                          </td>
                                        <td>
                                          <form class="update-cart-form" action="update-cart-item.php" method="POST">
                                            <input type="hidden" name="cartId" value="<?=$cartId?>">
                                            <input type="number" name="quantity" value="<?=$cartItem['quantity']?>" min="0">
                                            
                                        </form>
                                         

                                        </td>
                                        <td><?=$cartItem['price']?> SEK</td>


                                       
                                      </tr> 

                             <?php }; ?>

                             <tr>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td>Total: <?=$cartTotalSum?></td>
                             </tr>

               </tbody>
          </table>


            <form action="create-order.php" method="POST" style="text-align: left">
              <input type="hidden" name="totalPrice" value="<?=$cartTotalSum?>">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputFname">First Name</label>
                  <input type="text" class="form-control" name="firstName" id="inputFname">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputLname">Last Name</label>
                  <input type="text" class="form-control" name="lastName" id="inputLname">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail">Email</label>
                  <input type="text" class="form-control" name="email" id="inputEmail">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPhone">Phone</label>
                  <input type="text" class="form-control" name="phone" id="inputPhone">
                </div>
              </div>
              <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="adress" placeholder="Apartment, studio, or floor">
              </div>
              <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="text" class="form-control" id="inputPassword" name="password" placeholder="Apartment, studio, or floor">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">City</label>
                  <input type="text" name="city" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">country</label>
                  <select id="inputState" name="country" class="form-control">
                    
                    <option>SWEDEN</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">Zip</label>
                  <input type="text" name="postal_code" class="form-control" id="inputZip">
                </div>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    I agree with everything
                  </label>
                </div>
              </div>
              <button type="submit" name="createOrderBtn" class="btn btn-primary">confirm order</button>
            </form>






        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script type="text/javascript">

        $('.update-cart-form input[name="quantity"]').on('change', function(){
        

          
               $(this).parent().submit();

          });

   

</script>

