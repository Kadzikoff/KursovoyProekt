
function applyFilters() {
    let activityType = document.getElementById('activityType').value;
    let area = document.getElementById('area').value;
    let capacity = document.getElementById('capacity').value;
    let city = document.getElementById('city').value;
    let search = document.getElementById('search').value;

    $.ajax({
        url: 'filter.php',
        type: 'POST',
        data: {
            activityType: activityType,
            area: area,
            capacity: capacity,
            city: city,
            search: search
        },
        success: function(data) {
            $('#ResultBlocks').html(data);
        }
    });
}

