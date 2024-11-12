$(function(){

    const request = (url,params) => {
        $.post(url,params,function(result){
            if(JSON.parse(result).type == 'success'){
                window.location.href = JSON.parse(result).url
            }
            console.log(JSON.parse(result))
        })
    }

    $(".signin").on("click",function(evt){
        evt.preventDefault()
        let params = {username: $(".username").val().trim(),password: $(".password").val().trim()};
        let isEmpty = Object.values(params).some(param => param === "");
        !isEmpty ? request('../admin/signin',params) : console.log("One or more fields are empty");
    })

    const scrollTable = (direction) => {
        const tableWrapper = document.querySelector(".table-wrapper");
      
        if (!tableWrapper) return; // Ensure the element exists
      
        const scrollAmount = 1000; // Adjust as needed
        const scrollOptions = {
          behavior: 'smooth',
        };

        const flavoursScrollWidth = tableWrapper.scrollWidth;
        
      
        switch (direction) {
          case 'left':
            tableWrapper.scrollBy({ left: -scrollAmount, ...scrollOptions });
            break;
          case 'right':
            tableWrapper.scrollBy({ left: scrollAmount, ...scrollOptions });
            break;
          case 'start':
            // Scroll to the absolute start (leftmost position)
            tableWrapper.scrollTo({ left: 0, ...scrollOptions });
            break;
          case 'end':
            // Scroll to the absolute end (rightmost position)
           
            if (flavoursContainer.scrollLeft !== flavoursScrollWidth) {
                flavoursContainer.scrollTo(flavoursContainer.scrollLeft + 1, 0);
            }
            // const maxScrollLeft = tableWrapper.scrollWidth - tableWrapper.clientWidth;
            // tableWrapper.scrollTo({ left: maxScrollLeft, ...scrollOptions });
            break;
          default:
            break;
        }
      };
      
      
      

})