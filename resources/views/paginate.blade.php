<style>
    .paginate a{
        font-size: 16px;
        text-decoration: none;
        border: 1px solid #bbb;
        margin: 0 5px;
        padding: 2px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 75px;
        border-radius: 5px;
        color: #017925;
        transition: all .2s ease-in-out;
        
    }
    .paginate a:hover{
        background: #017925;
        color: #fff;
        border: transparent;
        font-weight: 600;
    }
    @media (max-width: 600px){
        .paginate a{
            font-size: 13px;
        }
    }
</style>
<div class="paginate">
    <a href="{{$materials->previousPageUrl()}}">
        Previous
    </a>
    
    <a href="{{$materials->nextPageUrl()}}">
       Next
    </a>
   
</div>
