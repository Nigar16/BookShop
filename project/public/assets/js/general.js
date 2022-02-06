const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

const UserUpdateView = (id) =>{

    $.ajax({
        type: "POST",
        url: "/user/view",
        data: {
            _token: CSRF_TOKEN, id: id,
        },
        success: function (data) {
                if(data){
                    console.log(data);
                    document.getElementById("edit_id").value =id;
                    document.getElementById("edit_name").value = data.name;
                    document.getElementById("edit_email").value = data.email;
                    document.getElementById("edit_position").value = data.position;
                    document.getElementById("edit_roles").value = data.roles;
                    document.getElementById("edit_status").value = data.status;
                    $('#edit').modal('show');
                }
        },
        error: function () {
            alert('Error... 5011');
        }
    })
};

const makePassword = () =>{
        document.getElementById("edit_password").value = generatePassword(8);
};

const makePassword_add = () =>{
    document.getElementById("add_password").value = generatePassword(8);
};

const generatePassword = (length) => {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%!';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
};

const SliderDeleteView = (id) => {
    let check = confirm("Silinən slider geri qaytarılmır!");

    if (check) {
        location.href = `/settings/slider/delete/${id}`;
    } else {
        alert("İmtina edildi");
    }
}

const SliderUpdateView=(id,url) => {
    $.ajax({
        type: "POST",
        url: "/slider/view",
        data: {
            _token: CSRF_TOKEN, id: id,
        },
        success: function (data) {
            if(data){
                console.log(data);
                document.getElementById("edit_id").value = id;
                document.getElementById("edit_name").value = data.name;
                document.getElementById("edit_url").value = data.url;
                document.getElementById("edit_status").value = data.status;
                document.getElementById("slider_img").innerHTML = `<img style="height: 150px; width: auto;" src="${url + data.img}">`;
                $('#slider_edit').modal('show');
            }
        },
        error: function () {
            alert('Error... something went wrong');
        }
    })
}

const ViewCustomer = (id,url) =>{

    $.ajax({
        type: "POST",
        url: "/customer/view",
        data: {
            _token: CSRF_TOKEN, id: id,
        },
        success: function (data) {
            console.log(data);

            if(data.status){
                document.getElementById("img").innerHTML = `<img style="height: 150px; width: auto;" src="${url + data.user.img}" />`;
                document.getElementById("name").innerHTML = data.user.name;
                document.getElementById("email").innerHTML = data.user.email;
                document.getElementById("phone").innerHTML = data.customer.phone;
                document.getElementById("address").innerHTML = data.customer.address;
                document.getElementById("date").innerHTML = data.customer.birthday;
                document.getElementById("status").innerHTML = data.customer.status === "1" ? "VIP"  :
                    data.customer.status === "2" ? "Standart" : "İstənməyən müştəri";
                $('#customerView').modal('show');
            }
            else{
                alert("Informasiya Yoxdur");
            }
        },
        error: function () {
            alert('Error... 5011');
        }
    })
};

const CustomerUpdateView = (id, url) => {
    $.ajax({
        type: "POST",
        url: "/customer/view",
        data: {
            _token: CSRF_TOKEN, id: id,
        },
        success: function (data) {
            if(data){
                console.log(data);
                if (data.status) {
                    document.getElementById("edit_id_customer").value = id;
                    document.getElementById("img_edit").innerHTML = `<img class="mb-2" style="height: 150px; width: auto;" src="${url + data.user.img}" \>`;
                    document.getElementById("edit_name_customer").value = data.user.name;
                    document.getElementById("edit_email_customer").value = data.user.email;
                    document.getElementById("edit_phone_customer").value = data.customer.phone;
                    document.getElementById("edit_address_customer").value = data.customer.address;
                    document.getElementById("edit_birthday_customer").value = data.customer.birthday;
                    document.getElementById("edit_status_customer").value = data.customer.status;
                    $('#customerEdit').modal('show');
                }
                else {
                    alert("İnformasiya Yoxdur");
                }
            }
        },
        error: function () {
            alert('Error... 5011');
        }
    })
}


const CategoryUpdateView= (id) =>{
    $.ajax({
        type: "POST",
        url: "/products/category/view",
        data: {
            _token: CSRF_TOKEN, id: id,
        },
        success: function (data) {
            if(data){
                console.log(data);
                document.getElementById("edit_id").value =id;
                document.getElementById("edit_name").value = data.name;
                document.getElementById("edit_main_category").value = data.main_category;
                if(data.main_category == "0"){
                    document.getElementById("edit_main_category").setAttribute("disabled", "disabled");
                }else{
                    document.getElementById("edit_main_category").removeAttribute( "disabled");
                }
                document.getElementById("edit_status").value = data.status;
                $('#categories_edit').modal('show');
            }
        },
        error: function () {
            alert('Error... something went wrong');
        }
    })
};


const ViewProduct = (id,url) =>{

    $.ajax({
        type: "POST",
        url: "/product/view",
        data: {
            _token: CSRF_TOKEN, id: id,
        },
        success: function (data) {

            if(data){
                console.log(data);
                if(data.status){
                    document.getElementById("img").innerHTML = `<img style="height: 150px; width: auto;" src="${url + data.product.img}" />`;
                    document.getElementById("name").innerHTML = data.product.name;
                    document.getElementById("category").innerHTML = data.category.name;
                    document.getElementById("author").innerHTML = data.product.author;
                    document.getElementById("description").innerHTML = data.product.description;
                    document.getElementById("price").innerHTML = data.product.price;
                    document.getElementById("read_count").innerHTML = data.product.read_count;
                    document.getElementById("status").innerHTML =data.product.status === "1" ? "Aktiv"  : "Deaktiv";
                    $('#productView').modal('show');
                }
                else{
                    alert("Informasiya Yoxdur");
                }
            }
        },
        error: function () {
            alert('Error... 5011');
        }
    })
};

const ProductDelete = (id) =>{

    let check = confirm("Silinən məhsul geri qaytarılmır!");

    if(check){
        location.href = `/products/product-delete/${id}`;
    }else{
        alert("İmtina edildi");
    }

};


const ProductUpdateView = (id, url) =>{

    $.ajax({
        type: "POST",
        url: "/products/product/view",
        data: {
            _token: CSRF_TOKEN, id: id,
        },
        success: function (data) {
            if(data){
                console.log(data);
                document.getElementById("edit_id").value = id;
                document.getElementById("edit_name").value = data.name;
                document.getElementById("edit_author").value = data.author;
                document.getElementById("edit_category").value = data.category_id;
                document.getElementsByClassName("note-editable")[0].innerHTML = data.description;
                document.getElementById("current_img").innerHTML = `<img style="height: 150px; width: auto;" src="${url + data.img}" />`;
                document.getElementById("edit_price").value = data.price;
                document.getElementById("edit_status").value = data.status;
                $('#productEdit').modal('show');
            }
        },
        error: function () {
            alert('Error... 5011');
        }
    })
};
