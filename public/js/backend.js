$(document).ready(function() {
    setInterval(function() {
        let day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
        var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
    

        let time = new Date()
        let formatTime = `${day[time.getDay()]}, ${time.getDate()} ${month[time.getMonth()]} ${time.getFullYear()} ${time.getHours()}:${time.getMinutes()}:${time.getSeconds()}`

        $('.time').html(formatTime)

    }, 1000)        

    $('[data-toggle="tooltip"]').tooltip({ 
        container: '.table' 
    })
})
