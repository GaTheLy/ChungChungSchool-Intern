<style>
    .nav__cont {
  position: fixed;
  width: 80px;
  border-radius: 0px 10px 10px 0px;
  top:0;
  left: 0;
  height: 100vh;
  background-color: #00598F;
  /* overflow:hidden; */
  transition:width .3s ease;
  cursor:pointer;
  /* animation */
  &:hover {
    width:220px;
  }
  /* @media screen and (min-width: 600px) {
    width: 80px;
  } */
}

.nav {
  list-style-type: none;
  color:white;
  &:first-child {
    padding-top:1.5rem;
  }
}

.nav__items {
    
  padding-bottom:1rem;
  font-family: 'Lexend Deca';
   a {
    position: relative;
    display:block;
    top:-30px;
    padding-left:15px;
    padding-right:15px;
    transition:all .3s ease;
    margin-left:25px;
    margin-right:10px;
    text-decoration: none;
    color:white;
    font-family: 'Lexend Deca';
    font-weight: 200;
    font-size: 20px;
     &:after {
       content:'';
       width: 100%;
       height: 100%;
       position: absolute;
       top:0;
       left:0;
       border-radius:2px;
       background:radial-gradient(circle at 94.02% 88.03%, #54a4ff, transparent 100%);
       opacity:0;
       transition:all .5s ease;
       z-index: -10;
     }
  }
  &:hover a:after {
    opacity:1;
  }
}




</style>


<nav class="nav__cont">
  <ul class="nav">
    <li class="nav__items ">
        <img src="assets-icon/icon-menu-white.png" style="width:32px; height:32px; ">
        <a href="">Menu</a>
    </li>
    
    <li class="nav__items ">
        <img src="assets-icon/icon-dash-white.png" style="width:32px; height:32px;">
        <a href="">Dashboard</a>
    </li>
      
    <li class="nav__items ">
        <img src="assets-icon/icon-listsubject-white.png" style="width:32px; height:32px; ">
        <a href="">Subject</a>
    </li>
      
    <li class="nav__items ">
        <img src="assets-icon/icon-homeroom-white.png" style="width:32px; height:32px;">
        <a href="">Homeroom</a>
    </li>
        
    <li class="nav__items ">
        <img src="assets-icon/icon-profile-white.png" style="width:32px; height:32px;">
        <a href="">Profile</a>
    </li>
      
    <li class="nav__items ">
        <img src="assets-icon/icon-setting-white.png" style="width:32px; height:32px;">
        <a href="">Settings</a>
    </li>

  </ul>
</nav>


