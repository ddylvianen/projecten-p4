<nav class="nav">
  <div class="nav-mobile">
    <a href="/">
      <h1 class="logo">FitForFun</h1>
    </a>
    <div id="hamburger-menu">
      <i class="fa-solid fa-bars"></i>
    </div>
  </div>
  <div class="nav-links-cont open">
    
    <div class="nav-links open">
      <a href="/">home</a>
      <a href="/lessen">lessen</a>
      <a href="/reservering">reserveringen</a>
      <?php
        if (isset($_SESSION['role'])){

          if($_SESSION['role'] == 'medewerker' || $_SESSION['role'] == 'admin'){
            echo "<a href='/overzicht'>medewerkerlessen</a>";
          }
          else{
            echo "<a href='/reservering'>lessenoverzicht</a>";
          }
        }
        else{
          echo "<a href='/reservering'>lessenoverzicht</a>";
        }
      ?>
    </div>

    <div class="nav-links nav-account open">
      <?php if (!empty($_SESSION)): ?>
        <a href="/logout">Logout</a>
      <?php else : ?>
        <a href="/login">Login</a>
        <a href="/signup">Sign up</a>
      <?php endif; ?>
    </div>
  </div>
</nav>