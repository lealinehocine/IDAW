body{
display: flex;
flex-direction: column;
justify-content: space-between;
height: 100vh;
}


.center{
    display: flex;
    flex-grow: 1;
    /*justify-content: space-between;*/
}

.container{
    flex-grow: 1;
}

.menu{
    display:block;
    width:20%;
    background-color: rgb(55, 55, 174);
    color: white;
    font-weight: 700;
    align-content: center;
    text-decoration: none;  
}

.menu li:hover {
    background-color: #ed2794;
    color: #ffe843;
    border-color: #ffe843;
}

a{
    text-decoration: none;  
}

.description{
    display: flex;
    flex-wrap: wrap;
}

ul{
    list-style:none;
    padding: 0; 


}

li{
    border: 1px solid #fff;
    text-align: center;
    padding: 5%;

}

h1, .bottom{
    text-align: center;
}