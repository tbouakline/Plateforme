<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Administration portail</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php?r=entreprise" class="nav-link">
              <i class="fas fa-user"></i>
              <p>
               Liste des entreprises
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?r=produit" class="nav-link">
              <i class="fas fa-cart-arrow-down"></i>
              <p>
               Liste des produits
              </p>
            </a>
          </li>



          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-check"></i>
              <p>
                Validation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?r=entreprise/validation-compte" class="nav-link">
                  <i class="fas fa-user"></i>
                  <p>Compte entreprise</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?r=produit/validation-produit-matiere" class="nav-link">
                  <i class="fas fa-cart-arrow-down"></i>
                  <p>Produit/Matière première</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?r=produit/validation-image" class="nav-link">
                  <i class="fas fa-image"></i>
                  <p>Image produit</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?r=caracteristique-produit/validation-caracteristique" class="nav-link">
                  <i class="fas fa-file-alt"></i>
                  <p>Caractéristique produit</p>
                </a>
              </li>
            
             
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>