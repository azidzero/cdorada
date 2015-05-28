function pregunta(id)
{ 
   if(confirm('¿Desea eliminar este registro?'))
    { 
        var nomform="del"+id;
       document.nomform.submit();
    } 
    else 
    {
        return false;
    }
} 