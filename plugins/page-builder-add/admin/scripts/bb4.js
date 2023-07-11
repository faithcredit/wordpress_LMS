(function ($) {

  if(popb_admin_vars_data.isPremActive === 'true'){
    $('.templatesInstallDivOne').hide();
    $('.tempPaca input:disabled').prop('disabled',false);
    $('.template-card input').next('label').html(' Select ');
  }
  

  $(document).on("click", ".updateTemplate", function () {
    $(".confirm_template_yes_replace").trigger("click");
  });

  $(document).on("click", ".confirm_template_yes_replace", function () {
    var isTemplateReplace = "false";

    if (pageBuilderApp.rowList.length > 0) {
      var isTemplateReplace = "false";
    } else {
      var isTemplateReplace = "true";
    }

    $(".popb_confirm_template_action_popup").css("display", "none");
    isConfirmTrue_c = true;

    var popb_selected_template = $("input[name=template_select]:checked").val();
    var pageOptions = "";
    if (isConfirmTrue_c == true) {
      var pageSeoName = $("#title").val();
      var PbPageStatus = $(".PbPageStatus").val();
      var pageLink = $("#editable-post-name-full").html();
      $(".pb_loader_container").css("display", "block");

      if (pageSeoName == "") {
        $("#title").val("PluginOps Page  - " + P_ID);
        pageSeoName = $("#title").val();
      }
      switch (popb_selected_template) {
        case "temp0":
          var currentAttrValue = jQuery(".templatesTabEditor")
            .children("a")
            .attr("href");
          jQuery(".pluginops-tabs " + currentAttrValue)
            .show()
            .siblings()
            .hide();
          jQuery(".templatesTabEditor")
            .addClass("pluginops-active")
            .siblings()
            .removeClass("pluginops-active");
          $(".pb_fullScreenEditorButton").trigger("click");
          $(".pb_loader_container").css("display", "none");
          return;

        break;
        default:
          break;
      }

    
      if(popb_admin_vars_data.isPremActive !== 'true'){
        const avlbleTemps = ['temp0', 'temp77', 'temp68', 'temp62', 'temp34', 'temp65', 'temp45', 'temp70', 'temp106', 'temp47', 'temp46', 'temp44', 'temp43', 'tempftp1', 'tempftp2', 'tempftp3', 'tempftp4', 'temp3', 'temp2', 'temp4', 'temp9'];

        if(!avlbleTemps.includes(popb_selected_template)){
          $(".pb_loader_container").css("display", "none");
          return;
        }
      }
        

      pageOptionsNeedToParse = "true";
      var model = "";

      try {
        // url: pluginURL+'/admin/scripts/templates/'+popb_selected_template+".json",

        getTemplateRequestURL =
          popb_admin_vars_data.templateLibURL +
          "/library/templates/" +
          popb_selected_template +
          ".json";

        if (popb_admin_vars_data.templateLibActive == "true") {
          getTemplateRequestURL =
            popb_admin_vars_data.templateLibURL +
            "/library/templates/" +
            popb_selected_template +
            ".json";
        }

        getTemplateLibraryRequestURL =
          adminAjaxUrl +
          "?action=popb_get_template&submitNonce=" +
          POPB_data_nonce +
          "&templateID=" +
          popb_selected_template;

        $.ajax({
          type: "GET",
          dataType: "json",
          url: getTemplateRequestURL,
          data: { get_param: "value" },
          success: function (data) {
            model = data;
            if (pageOptions == "") {
              if (typeof model["pageOptions"] != "undefined") {
                pageOptions = model["pageOptions"];
                pageOptionsNeedToParse = "false";
              }
              if (typeof model["Rows"] != "undefined") {
                model = model["Rows"];
              }
            }

            if (model == "") {
              $(".pb_loader_container").slideUp(200);
            } else {
              if (isTemplateReplace == "true") {
                var ex_modelRows;
                while ((ex_modelRows = pageBuilderApp.rowList.first())) {
                  ex_modelRows.destroy();
                }

                $.each(model, function (index, val) {
                  val["rowID"] =
                    "ulpb_Row" + Math.floor(Math.random() * 200000 + 100);
                  pageBuilderApp.rowList.add(val);
                });

                pageBuilderApp.PageBuilderModel.set("pageStatus", PbPageStatus);
                if (pageOptions !== "") {
                  if (pageOptionsNeedToParse == "true") {
                    parsedPageOptions = JSON.parse(pageOptions);
                  } else {
                    parsedPageOptions = pageOptions;
                  }

                  parsedPageOptions["pageLink"] = pageLink;
                  parsedPageOptions["pageSeoName"] = pageSeoName;

                  pageBuilderApp.PageBuilderModel.set(
                    "pageOptions",
                    parsedPageOptions
                  );
                }
                var savedPageID = pageBuilderApp.PageBuilderModel.get("pageID");
                if (P_ID !== savedPageID) {
                  pageBuilderApp.PageBuilderModel.set("pageID", P_ID);
                  var savedPageID =
                    pageBuilderApp.PageBuilderModel.get("pageID");
                  //console.log(savedPageID);
                }

                setTimeout(function () {
                  $(".pb_loader_container").slideUp(200);
                  var pageOptions =
                    pageBuilderApp.PageBuilderModel.get("pageOptions");
                  var pageStatus =
                    pageBuilderApp.PageBuilderModel.get("pageStatus");
                  renderPageOps(pageOptions, pageStatus);
                  pageBuilderApp.PgCollectionView.render();

                  var currentAttrValue = jQuery(
                    ".templatesTabEditor .pluginops-tab_link"
                  ).attr("href");

                  jQuery(".pluginops-tabs " + currentAttrValue)
                    .show()
                    .siblings()
                    .hide();

                  jQuery(".templatesTabEditor .pluginops-tab_link")
                    .parent("li")
                    .addClass("pluginops-active")
                    .siblings()
                    .removeClass("pluginops-active");

                  $(".pb_fullScreenEditorButton").trigger("click");
                  //window.location.href = admURL+'post.php?post='+P_ID+'&action=edit';
                }, 100);
                console.log("Saved");
              } else {
                $.each(model, function (index, val) {
                  val["rowID"] =
                    "ulpb_Row" + Math.floor(Math.random() * 200000 + 100);
                  pageBuilderApp.rowList.add(val);
                });

                $(".pb_loader_container").slideUp(200);

                var currentAttrValue = jQuery(
                  ".templatesTabEditor .pluginops-tab_link"
                ).attr("href");

                jQuery(".pluginops-tabs " + currentAttrValue)
                  .show()
                  .siblings()
                  .hide();

                jQuery(".templatesTabEditor .pluginops-tab_link")
                  .parent("li")
                  .addClass("pluginops-active")
                  .siblings()
                  .removeClass("pluginops-active");

                $(".pb_fullScreenEditorButton").trigger("click");
              }
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $.ajax({
              type: "GET",
              dataType: "json",
              url: getTemplateLibraryRequestURL,
              data: { get_param: "value" },
              success: function (data) {
                model = data;
                if (pageOptions == "") {
                  if (typeof model["pageOptions"] != "undefined") {
                    pageOptions = model["pageOptions"];
                    pageOptionsNeedToParse = "false";
                  }
                  if (typeof model["Rows"] != "undefined") {
                    model = model["Rows"];
                  }
                }

                if (model == "") {
                  $(".pb_loader_container").slideUp(200);
                } else {
                  if (isTemplateReplace == "true") {
                    var ex_modelRows;
                    while ((ex_modelRows = pageBuilderApp.rowList.first())) {
                      ex_modelRows.destroy();
                    }

                    $.each(model, function (index, val) {
                      val["rowID"] =
                        "ulpb_Row" + Math.floor(Math.random() * 200000 + 100);
                      pageBuilderApp.rowList.add(val);
                    });

                    pageBuilderApp.PageBuilderModel.set(
                      "pageStatus",
                      PbPageStatus
                    );
                    if (pageOptions !== "") {
                      if (pageOptionsNeedToParse == "true") {
                        parsedPageOptions = JSON.parse(pageOptions);
                      } else {
                        parsedPageOptions = pageOptions;
                      }

                      parsedPageOptions["pageLink"] = pageLink;
                      parsedPageOptions["pageSeoName"] = pageSeoName;

                      pageBuilderApp.PageBuilderModel.set(
                        "pageOptions",
                        parsedPageOptions
                      );
                    }
                    var savedPageID =
                      pageBuilderApp.PageBuilderModel.get("pageID");
                    if (P_ID !== savedPageID) {
                      pageBuilderApp.PageBuilderModel.set("pageID", P_ID);
                      var savedPageID =
                        pageBuilderApp.PageBuilderModel.get("pageID");
                      //console.log(savedPageID);
                    }

                    setTimeout(function () {
                      $(".pb_loader_container").slideUp(200);
                      var pageOptions =
                        pageBuilderApp.PageBuilderModel.get("pageOptions");
                      var pageStatus =
                        pageBuilderApp.PageBuilderModel.get("pageStatus");
                      renderPageOps(pageOptions, pageStatus);
                      pageBuilderApp.PgCollectionView.render();

                      var currentAttrValue = jQuery(
                        ".templatesTabEditor .pluginops-tab_link"
                      ).attr("href");

                      jQuery(".pluginops-tabs " + currentAttrValue)
                        .show()
                        .siblings()
                        .hide();

                      jQuery(".templatesTabEditor .pluginops-tab_link")
                        .parent("li")
                        .addClass("pluginops-active")
                        .siblings()
                        .removeClass("pluginops-active");

                      $(".pb_fullScreenEditorButton").trigger("click");
                      //window.location.href = admURL+'post.php?post='+P_ID+'&action=edit';
                    }, 100);
                    console.log("Saved");
                  } else {
                    $.each(model, function (index, val) {
                      val["rowID"] =
                        "ulpb_Row" + Math.floor(Math.random() * 200000 + 100);
                      pageBuilderApp.rowList.add(val);
                    });

                    $(".pb_loader_container").slideUp(200);

                    var currentAttrValue = jQuery(
                      ".templatesTabEditor .pluginops-tab_link"
                    ).attr("href");

                    jQuery(".pluginops-tabs " + currentAttrValue)
                      .show()
                      .siblings()
                      .hide();

                    jQuery(".templatesTabEditor .pluginops-tab_link")
                      .parent("li")
                      .addClass("pluginops-active")
                      .siblings()
                      .removeClass("pluginops-active");

                    $(".pb_fullScreenEditorButton").trigger("click");
                  }
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                jQuery(".popb_install_template_library").css(
                  "display",
                  "block"
                );

                jQuery(".confirm_safemode_no").on("click", function () {
                  jQuery(".popb_install_template_library").css(
                    "display",
                    "none"
                  );
                  location.reload();
                });
              },
            });
          },
        });
      } catch (error) {
        console.log(error);
        jQuery(".popb_safemode_popup").css("display", "block");

        jQuery(".confirm_safemode_no").on("click", function () {
          jQuery(".popb_safemode_popup").css("display", "none");
          location.reload();
        });

        popb_errorLog.errorMsg = error.message;
        popb_errorLog.errorURL = error.stack.split("\n")[1];

        jQuery(".fullErrorMessage p").text("Click To View Full Error Message");
        jQuery(".fullErrorMessageInput").val(popb_errorLog.errorMsg);

        jQuery(".confirm_safemode_yes").on("click", function () {
          jQuery.ajax({
            url:
              admURL +
              "/admin-ajax.php?action=popb_enable_safe_mode&POPB_nonce=" +
              shortCodeRenderWidgetNO,
            method: "post",
            data: {
              errorMsg: popb_errorLog.errorMsg,
              errorURL: popb_errorLog.errorURL,
            },
            success: function (result) {
              location.reload();
            },
          });
        });
      }
    }
  });

  $(document).ready(function () {
    $(".rowBlockUpdateBtn").on("click", function (ev) {
      var blockName = $(ev.target).attr("data-rowBlockName");
      var rowBlock = "";
      var modelIndex = $(".insertRowBlockAtIndex").val();
      modelIndex = parseInt(modelIndex) + 1;

      // url: pluginURL+'/admin/scripts/blocks/rowBlocks/'+blockName+''+".json",

      getTemplateRequestURL =
        adminAjaxUrl +
        "?action=popb_get_row_blocks&submitNonce=" +
        POPB_data_nonce +
        "&blockID=" +
        blockName;

      if (popb_admin_vars_data.templateLibActive == "true") {
        getTemplateRequestURL =
          popb_admin_vars_data.templateLibURL +
          "/library/blocks/rowBlocks/" +
          blockName +
          "" +
          ".json";
      }

      $.ajax({
        type: "GET",
        dataType: "json",
        url: getTemplateRequestURL,
        data: { get_param: "value" },
        success: function (data) {
          rowBlock = data;

          if (typeof rowBlock["multiRows"] != "undefined") {
            //console.log(rowBlock['multiRows'])

            $.each(rowBlock["multiRows"], function (index, val) {
              var addModelAtIndex = parseInt(index) + parseInt(modelIndex);
              val["rowID"] =
                "ulpb_Row" + Math.floor(Math.random() * 300000 + 100);
              pageBuilderApp.rowList.add(val, { at: addModelAtIndex });

              var duplicatedModel = pageBuilderApp.rowList.at(addModelAtIndex);
              var rowCID = duplicatedModel.cid;
              var thisChangeRedoProps = {
                changeModelType: "rowSpecialAction",
                thisModelCId: rowCID,
                thisModelElId: val["rowID"],
                specialAction: "duplicate",
                thisModelVal: duplicatedModel,
                thisModelIndex: addModelAtIndex,
              };
              sendDataBackToUndoStack(thisChangeRedoProps);
            });
            $(".insertRowBlock").css("display", "none");
          } else {
            rowBlock["rowID"] =
              "ulpb_Row" + Math.floor(Math.random() * 300000 + 100);
            if (rowBlock != "") {
              pageBuilderApp.rowList.add(rowBlock, { at: modelIndex });

              var duplicatedModel = pageBuilderApp.rowList.at(modelIndex);
              var rowCID = duplicatedModel.cid;
              var thisChangeRedoProps = {
                changeModelType: "rowSpecialAction",
                thisModelCId: rowCID,
                thisModelElId: rowBlock["rowID"],
                specialAction: "duplicate",
                thisModelVal: duplicatedModel,
                thisModelIndex: modelIndex,
              };

              sendDataBackToUndoStack(thisChangeRedoProps);
              $(".insertRowBlock").hide(300);
            } else {
            }
          }

          $(".insertRowBlockAtIndex").val("");
          pageBuilderApp.ifChangesMade = true;
        },
        error: function (thrownError) {
          alert("Some Error Occurred");
          console.log(thrownError);
        },
      });
    });

    $(document).on("click", ".addNewRowBlockVisible", function (ev) {
      modelIndex = pageBuilderApp.rowList.length;
      $(".insertRowBlockAtIndex").val(modelIndex - 1);

      $(".ulpb_column_controls").hide();
      hideWidgetOpsPanel();
      $(".pageops_modal").hide(300);
      $(".edit_column").hide(300);

      $(".insertRowBlock").show(300);
    });
    $(".insertRowBlockClosebutton").on("click", function (ev) {
      $(".insertRowBlock").hide(300);
    });
  });
})(jQuery);
