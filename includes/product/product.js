
    $(document).ready(function() {
        $("#pay_button,#edit_button,#remove_button,#export_button,#invoice_button,#add_photo_button").click(function () {
            var count = $("input:checkbox:checked").length
            if (count == 0) {
                alert("select at least \"one\" checkbox")
                return false
            } else if (count > 1) {
                alert("Not select more than \"one\" checkbox")
                return false
            } else {
                var value = $("input:checkbox:checked").val();
                var button_name = $(this).attr("name")
                if (button_name == "export") {
                    var win = window.open("products.php?export_id=" + value + "", "_blank");
                    if (win) {
                        win.focus();
                    } else {
                        alert("Please allow popups for this website");
                    }
                }
                if (button_name == "invoice") {
                    $.ajax({
                        type: "GET",
                        url: "products.php",
                        data: {
                            "get_invoice_lang": value
                        },
                        success: function (data) {
                            $("#invoice_body").html(data);
                        }
                    });
                }

                if (button_name == "edit") {
                    $.ajax({
                        type: "GET",
                        url: "products.php",
                        data: {
                            "edit_id": value
                        },
                        success: function (data) {
                            $("#edit_body").html(data);
                        }
                    });
                }
                if (button_name == "pay") {
                    $.ajax({
                        type: "GET",
                        url: "products.php",
                        data: {
                            "pay_id": value
                        },
                        success: function (data) {
                            $("#pay_body").html(data);
                        }
                    });
                }
                if (button_name == "add_photo") {
                    $.ajax({
                        type: "GET",
                        url: "products.php",
                        data: {
                            "add_photo_id": value
                        },
                        success: function (data) {
                            $("#add_photo_body").html(data);
                        }
                    });
                }
                if (button_name == "remove") {
                    $.ajax({
                        type: "GET",
                        url: "products.php",
                        data: {
                            "remove_id": value
                        },
                        success: function (data) {
                            $("#remove_body").html(data);
                        }
                    });
                }
            }
        });
            });



            $(function() {
                $("#metal_type").on('change', function(e) {
                  e.preventDefault();
                  if (this.value == 'gold') {
                    document.getElementById('ph_purity').innerHTML = `
          <div class="mb-3">
            <label for="input1" class="form-label">Purity</label>
            <select class="dropdown" name="purity" id="purity">
              <option></option>
              <option value="22k">22K</option>
              <option value="20k">20K</option>
              <option value="18k">18K</option>
              <option value="24k">24K</option>
              </select>
          </div>
          <div class="mb-3">
            <label for="input2" class="form-label">Product Type</label>
            <select class="dropdown" name="product_type" id="product_type">
              <option></option>
              <option value="necklace">Necklace</option>
              <option value="ear_rings">Ear rings</option>
              <option value="bracelets">Bracelets</option>
              <option value="pendents">pendents</option>
              <option value="rings">Rings</option>
              <option value="chains">Chains</option>
              <option value="dollars">Dollars</option>
              <option value="gold_biscuits">Gold Biscuits</option>
              <option value="gold_lamps">Gold Lamps</option>
              </select>
          </div>
        `;
                  } else if (this.value == 'silver') {
                    document.getElementById('ph_purity').innerHTML = `
          <div class="mb-3">
            <label for="input1" class="form-label">Select Product Type</label>
            <select class="dropdown" name="product_type" id="product_type">
              <option></option>
              <option value="Silver Anklets - Kolusu">Silver Anklets - Kolusu</option>
              <option value="metti">Metti</option>
              <option value="kayiru">Kayiru</option>
              </select>
          </div>
        `;
                  } else {
                    document.getElementById('ph_purity').innerHTML = `
          <div class="mb-3">
            <label for="input1" class="form-label">Select Product Type</label>
            <select class="dropdown" name="product_type" id="product_type">
              <option></option>
              <option value="diamond_necklace">Diamond Necklace</option>
              <option value="diamond_earrings">Diamond Earrings</option>
              <option value="diamond_Nosepin">Diamond Nosepin</option>
              </select>
          </div>
        `;
                  }
                })
              });
          