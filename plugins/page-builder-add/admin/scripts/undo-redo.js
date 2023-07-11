
var stackUndo = [];
var stackRedo = [];


/* Widget List ops render functions */
function renderFormBuilderFieldsList(formFieldsArray,mcSavedGroups,mrSavedGroups){
            if (typeof(formFieldsArray) == 'undefined' ) {
                return false;
            }

            pageBuilderApp.doesthisfieldhavemcgroups = false;
            jQuery('.formFieldItemsContainer').html('');
            jQuery.each(formFieldsArray,function(index, val){

                    fieldLabel = val["thisFieldOptions"]["fbFieldLabel"];
                    if (fieldLabel == '') {
                        fieldLabel = 'Field ';
                    }

                    fieldLabel  = fieldLabel.slice(0,30);

                    if (typeof( val["thisFieldOptions"]["fbFieldPreset"] ) == 'undefined' ) { val["thisFieldOptions"]["fbFieldPreset"] =  ''; }
                    if (typeof( val["thisFieldOptions"]["fbFieldName"] ) == 'undefined' ) { val["thisFieldOptions"]["fbFieldName"] =  ''; }

                    if (typeof( val["thisFieldOptions"]["fbTextContent"] ) == 'undefined' ) { val["thisFieldOptions"]["fbTextContent"] =  ''; }

                    fbFieldTypetext = ''; fbFieldTypetext = ''; fbFieldTypetel = ''; fbFieldTypeemail = ''; fbFieldTypenumber = ''; fbFieldTypeurl = ''; fbFieldTypedate = ''; fbFieldTypetime = ''; fbFieldTypetextarea = ''; fbFieldTyperadio = ''; fbFieldTypecheckbox = ''; fbFieldTypehidden = ''; fbFieldTypehtml = ''; fbFieldTypemcgroups = ''; fbFieldTypeselect = ''; fbFieldTypemrgroups = '';

                    switch(val["fbFieldType"]) {
                        case 'text':
                            fbFieldTypetext = 'selected';
                        break;
                        case 'tel':
                            fbFieldTypetel = 'selected';
                        break;
                        case 'email':
                            fbFieldTypeemail = 'selected';
                        break;
                        case 'number':
                            fbFieldTypenumber = 'selected';
                        break;
                        case 'url':
                            fbFieldTypeurl = 'selected';
                        break;
                        case 'date':
                            fbFieldTypedate = 'selected';
                        break;
                        case 'time':
                            fbFieldTypetime = 'selected';
                        break;
                        case 'textarea':
                            fbFieldTypetextarea = 'selected';
                        break;
                        case 'select':
                            fbFieldTypeselect = 'selected';
                        break;
                        case 'radio':
                            fbFieldTyperadio = 'selected';
                        break;
                        case 'checkbox':
                            fbFieldTypecheckbox = 'selected';
                        break;
                        case 'hidden':
                            fbFieldTypehidden = 'selected';
                        break;
                        case 'html':
                            fbFieldTypehtml = 'selected';
                        break;
                        case 'mcgroups':
                            fbFieldTypemcgroups = 'selected';
                        break;
                        case 'mrgroups':
                            fbFieldTypemrgroups = 'selected';
                        break;
                    }


                    fbFieldWidth100 = ''; fbFieldWidth20 = ''; fbFieldWidth25 = ''; fbFieldWidth33 = ''; fbFieldWidth40 = ''; fbFieldWidth50 = ''; fbFieldWidth60 = ''; fbFieldWidth66 = ''; fbFieldWidth75 = ''; fbFieldWidth80 = ''; fbFieldWidth100 = '';

                    switch(val["thisFieldOptions"]["fbFieldWidth"]) {
                        case '100':
                            fbFieldWidth100 = 'selected';
                        break;
                        case '20':
                            fbFieldWidth20 = 'selected';
                        break;
                        case '25':
                            fbFieldWidth25 = 'selected';
                        break;
                        case '33':
                            fbFieldWidth33 = 'selected';
                        break;
                        case '40':
                            fbFieldWidth40 = 'selected';
                        break;
                        case '50':
                            fbFieldWidth50 = 'selected';
                        break;
                        case '60':
                            fbFieldWidth60 = 'selected';
                        break;
                        case '66':
                            fbFieldWidth66 = 'selected';
                        break;
                        case '75':
                            fbFieldWidth75 = 'selected';
                        break;
                        case '80':
                            fbFieldWidth80 = 'selected';
                        break;
                    }

                    fbFieldRequiredFalse = ''; fbFieldRequiredTrue = '';
                    if (val["thisFieldOptions"]["fbFieldRequired"] == 'false') {
                        fbFieldRequiredFalse = 'selected';
                    }

                    if (val["thisFieldOptions"]["fbFieldRequired"] == 'true') {
                        fbFieldRequiredTrue = 'selected';
                    }

                    displayFieldsInlineFalse = ''; displayFieldsInlineTrue = '';
                    if (val["thisFieldOptions"]["displayFieldsInline"] == 'block') {
                        displayFieldsInlineFalse = 'selected';
                    }

                    if (val["thisFieldOptions"]["displayFieldsInline"] == 'inline-block') {
                        displayFieldsInlineTrue = 'selected';
                    }

                    if (typeof(val["thisFieldOptions"]["mrgrpftype"]) == 'undefined') {
                        val["thisFieldOptions"]["mrgrpftype"] = '';
                    }

                    mrgrpftypeRadio = ''; mrgrpftypeCheckBox= '';
                    if (val["thisFieldOptions"]["mrgrpftype"] == 'Radio') {
                        mrgrpftypeRadio = 'selected';
                    }else{
                        mrgrpftypeCheckBox = 'selected';
                    }

                    if (typeof(val["thisFieldOptions"]["mcgrpftype"]) == 'undefined') {
                        val["thisFieldOptions"]["mcgrpftype"] = '';
                    }

                    mcgrpftypeRadio = ''; mcgrpftypeCheckBox= '';
                    if (val["thisFieldOptions"]["mcgrpftype"] == 'Radio') {
                        mcgrpftypeRadio = 'selected';
                    }else{
                        mcgrpftypeCheckBox = 'selected';
                    }


                    let fbTextContent = val["thisFieldOptions"]["fbTextContent"].replace(/"/g, "'");

                    

                    jQuery('.formFieldItemsContainer').append('<li class="fieldNo-'+index+'">'+
                        '<h3 class="handleHeader">'+fieldLabel+'<span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span> <span class="dashicons dashicons-admin-page slideDuplicateButton" style="float: right;" title="Duplicate"></span>  </h3>'+
                        '<div  class="accordContentHolder" style="background: #fff;"> '+

                            '<label>Type : </label>'+
                            '<select class="fbFieldType" data-optname="widgetPbFbFormFeilds.'+index+'.fbFieldType"> '+
                                '<option value="text" '+fbFieldTypetext+'>Text</option> '+
                                '<option value="tel" '+fbFieldTypetel+'>Tel</option> '+
                                '<option value="email" '+fbFieldTypeemail+'>Email</option> '+
                                '<option value="number" '+fbFieldTypenumber+'>Number</option> '+
                                '<option value="url" '+fbFieldTypeurl+'>URL</option> '+
                                '<option value="date" '+fbFieldTypedate+'>Date</option> '+
                                '<option value="time" '+fbFieldTypetime+'>Time</option> '+
                                '<option value="textarea" '+fbFieldTypetextarea+'>Textarea</option> '+
                                '<option value="select" '+fbFieldTypeselect+'>Select</option> '+
                                '<option value="radio" '+fbFieldTyperadio+'>Radio</option> '+
                                '<option value="checkbox" '+fbFieldTypecheckbox+'>Checkbox</option> '+
                                '<option value="hidden" '+fbFieldTypehidden+'>Hidden</option> '+
                                '<option value="html" '+fbFieldTypehtml+'>Text/HTML</option> '+
                                '<option value="mcgroups" '+fbFieldTypemcgroups+'>MailChimp Groups</option> '+
                                '<option value="mrgroups" '+fbFieldTypemrgroups+'>MailRelay Groups</option> '+
                            '</select> <br> <br> <hr> <br> '+

                            '<div class="thisFieldOptions"> '+

                                '<label> Label :</label> <input type="text" class="fbFieldLabel" value="'+val["thisFieldOptions"]["fbFieldLabel"]+'" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.fbFieldLabel" > <br> <br> <hr> <br> '+

                                '<label> Field Name :</label> <input type="text" class="fbFieldName" value="'+val["thisFieldOptions"]["fbFieldName"]+'" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.fbFieldName" > <br> <br> <hr> <br> '+

                                ' <label> Placeholder :</label> <input type="text" class="fbFieldPlaceHolder" value="'+val["thisFieldOptions"]["fbFieldPlaceHolder"]+'" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.fbFieldPlaceHolder" > <br> <br> <hr> <br> '+

                                ' <label> Required :</label> <select class="fbFieldRequired" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.fbFieldRequired" > '+
                                    '<option value="false" '+fbFieldRequiredFalse+'>No</option>'+
                                    '<option value="true" '+fbFieldRequiredTrue+'>Yes</option>'+
                                '</select> <br> <br> <hr> <br> '+

                                ' <label> Field Width :</label>'+
                                '<select class="fbFieldWidth" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.fbFieldWidth" >'+
                                    '<option value="100" '+fbFieldWidth100+'>Default</option> '+
                                    '<option value="20" '+fbFieldWidth20+'>20%</option> '+
                                    '<option value="25" '+fbFieldWidth25+'>25%</option> '+
                                    '<option value="33" '+fbFieldWidth33+'>33%</option> '+
                                    '<option value="40" '+fbFieldWidth40+'>40%</option> '+
                                    '<option value="50" '+fbFieldWidth50+'>50%</option> '+
                                    '<option value="60" '+fbFieldWidth60+'>60%</option> '+
                                    '<option value="66" '+fbFieldWidth66+'>66%</option> '+
                                    '<option value="75" '+fbFieldWidth75+'>75%</option> '+
                                    '<option value="80" '+fbFieldWidth80+'>80%</option> '+
                                    '<option value="100" '+fbFieldWidth100+'>100%</option> '+
                                '</select> <br> <br> <hr> <br> '+

                                ' <label> Preset Value :</label>  <input type="text" class="fbFieldPreset" value="'+val["thisFieldOptions"]["fbFieldPreset"]+'" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.fbFieldPreset" >   <br> <br> <hr> <br>  '+

                            '</div> <br> <br> '+
                            '<div class="textareaOptions pb_hidden"> '+
                                '<label>Textarea Rows: </label> <input type="number" class="fbtextareaRows" value="'+val["thisFieldOptions"]["fbtextareaRows"]+'" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.fbtextareaRows" > <br> <hr> <br> <br> '+
                            '</div>'+
                            '<div class="textHtmlFeildOptions pb_hidden"> '+
                                '<label>Enter Text or HTML :</label> '+
                                '<textarea class="fbTextContent" rows="6" value="'+fbTextContent+'" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.fbTextContent" style="width:310px;" >'+fbTextContent+'</textarea>'+
                                '<br><hr><br><br>'+
                            '</div>'+
                            '<div class="multiOptionField pb_hidden"> '+
                                '<label>Options: </label>'+
                                '<textarea class="multiOptionFieldValues" rows="5" value="'+val["thisFieldOptions"]["multiOptionFieldValues"]+'" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.multiOptionFieldValues" style="width:330px;" >'+val["thisFieldOptions"]["multiOptionFieldValues"]+'</textarea> <br> <span> Enter each option in separate line.</span> <br> <hr> <br> <br> '+
                                '<label>Display Inline :</label>'+
                                '<select class="displayFieldsInline" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.displayFieldsInline">'+
                                    '<option value="inline-block" '+displayFieldsInlineTrue+'>Yes</option>'+
                                    '<option value="block" '+displayFieldsInlineFalse+'>No</option> '+
                                '</select> <br> <hr> <br> <br> '+
                            '</div>'+

                            '<div class="mcgroupsFieldContainer pb_hidden">'+
                                '<label>Group Field Type :</label>'+
                                '<select class="mcgrpftype" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.mcgrpftype" value="'+val["thisFieldOptions"]["mcgrpftype"]+'" >'+
                                    '<option value=""> None </option>'+
                                    '<option value="Radio" '+mcgrpftypeRadio+'> Radio </option>'+
                                    '<option value="Checkbox" '+mcgrpftypeCheckBox+'> Checkbox </option>'+
                                '</select>'+
                                '<br><br><hr><br>'+
                                '<div class="formBuilderMCFieldGroupsDiv" style="display:none;">'+
                                    '<label>Select Group</label>'+
                                    '<select class="formBuilderMCFieldGroups" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.formBuilderMCFieldGroups" value="'+val["thisFieldOptions"]["formBuilderMCFieldGroups"]+'" >'+
                                        '<option value="">none</option>'+
                                    '</select>'+
                                    '<br><br><hr><br>'+
                                '</div>'+
                                '<div class="mcGetGrpsFieldBtn" style="padding: 5px 15px; background: #8BC34A; width: 190px; text-align: center; font-size: 16px; color: #fff; border-radius: 5px; margin-left: 0; cursor:pointer;"> Get Groups For This List </div>'+
                                '<br>'+
                                '<div class="mcGroupsFieldLoader" style="display: none;"> Connecting...</div>'+
                                '<br>'+
                            '</div>'+


                            '<div class="mrgroupsFieldContainer pb_hidden">'+
                                '<label>Group Field Type :</label>'+
                                '<select class="mrgrpftype" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.mrgrpftype" value="'+val["thisFieldOptions"]["mrgrpftype"]+'" >'+
                                    '<option value=""> None </option>'+
                                    '<option value="Radio" '+mrgrpftypeRadio+'> Radio </option>'+
                                    '<option value="Checkbox" '+mrgrpftypeCheckBox+'> Checkbox </option>'+
                                '</select>'+
                                '<br><br><hr><br>'+
                                '<div class="formBuilderMRFieldGroupsDiv" style="display:none;">'+
                                    '<label>Enter Group Id\'s</label>'+
                                    '<input type="text" class="formBuilderMRFieldGroups" data-optname="widgetPbFbFormFeilds.'+index+'.thisFieldOptions.formBuilderMRFieldGroups" value="'+val["thisFieldOptions"]["formBuilderMRFieldGroups"]+'" >'+
                                    '<span style="font-size:12px;">Comma separated values</span>'+
                                    '<br><br><hr><br>'+
                                '</div>'+
                                '<div class="mailRelayGetGrpsFieldBtn" style="padding: 5px 15px; background: #8BC34A; width: 190px; text-align: center; font-size: 16px; color: #fff; border-radius: 5px; margin-left: 0; cursor:pointer;"> Get Groups For MailRelay </div>'+
                                '<br>'+
                                '<div class="mrGroupsFieldLoader" style="display: none;"> Connecting...</div>'+
                                '<br>'+
                            '</div>'+

                        '</div> '+
                    '</li>');

                    jQuery( '.formFieldItemsContainer' ).accordion( "refresh" );
                    
                    

                    

                    if (val["fbFieldType"] == 'textarea') {
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.textareaOptions').removeClass('pb_hidden');
                    } else if(val["fbFieldType"] == 'select' || val["fbFieldType"] == 'checkbox' || val["fbFieldType"] == 'radio'){
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.multiOptionField').removeClass('pb_hidden');
                    }

                    if (val["fbFieldType"] == 'html') {
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.textHtmlFeildOptions').removeClass('pb_hidden');
                    }

                    if (val["fbFieldType"] == 'mcgroups') {

                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.textHtmlFeildOptions').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.multiOptionField').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.textareaOptions').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.thisFieldOptions').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.mcgroupsFieldContainer').removeClass('pb_hidden');


                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.mcgroupsFieldContainer').children('.mcgrpftype').val( val["thisFieldOptions"]["mcgrpftype"] );
                        

                        pageBuilderApp.thisMCSelectedGroupField = val["thisFieldOptions"]["formBuilderMCFieldGroups"];

                        jQuery('.formBuilderMCFieldGroups').html("<option value='false'>None</option>");
                        if (mcSavedGroups != 'false') {

                            thisMcAllGroupsFields = '';
                            groups = '';
                            mcSavedGroupsParsed = JSON.parse(mcSavedGroups);
                            groups = mcSavedGroupsParsed['success'];
                            jQuery.each(groups, function(title,arrayVal){
                                
                                thisMcGroup = '<option value="'+title+'"> '+title+' </option>';
                                thisMcAllGroupsFields = thisMcAllGroupsFields + thisMcGroup;

                            });

                            
                            jQuery('.formBuilderMCFieldGroups').html( "<option value='false'>None</option>" + thisMcAllGroupsFields);
                            jQuery('.formBuilderMCFieldGroupsDiv').css('display','block');
                            jQuery('.formBuilderMCFieldGroups').val(pageBuilderApp.thisMCSelectedGroupField);
                        }

                    }


                    if (val["fbFieldType"] == 'mrgroups') {

                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.textHtmlFeildOptions').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.multiOptionField').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.textareaOptions').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.thisFieldOptions').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.mcgroupsFieldContainer').addClass('pb_hidden');
                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.mrgroupsFieldContainer').removeClass('pb_hidden');


                        jQuery('.fieldNo-'+index).children('.accordContentHolder').children('.mrgroupsFieldContainer').children('.mrgrpftype').val( val["thisFieldOptions"]["mrgrpftype"] );
                        

                        pageBuilderApp.thisMRSelectedGroupField = val["thisFieldOptions"]["formBuilderMRFieldGroups"];
                        jQuery('.formBuilderMRFieldGroups').html("<option value='false'>None</option>");
                        if (mrSavedGroups != 'false') {

                            thisMrAllGroupsFields = '';
                            mrSavedGroupsParsed = JSON.parse(mrSavedGroups);

                            jQuery.each(mrSavedGroupsParsed, function(title,arrayVal){
                                thisMrGroup = '<option value="'+arrayVal['id']+'"> '+arrayVal['name']+' </option>';
                                thisMrAllGroupsFields = thisMrAllGroupsFields + thisMrGroup;

                            });

                            
                            jQuery('.formBuilderMRFieldGroups').html( "<option value='false'>None</option>" + thisMrAllGroupsFields);
                            jQuery('.formBuilderMRFieldGroupsDiv').css('display','block');
                            jQuery('.formBuilderMRFieldGroups').val(pageBuilderApp.thisMRSelectedGroupField);
                        }
                            


                    }

            }); //loops end
}

function renderIconListItemsList(fieldsArray){
            jQuery('.iconListItemsContainer').html('');
            jQuery.each(fieldsArray,function(index, val){
               iconListItemTextLimited  = val['iconListItemText'].slice(0,30)+'...';
                jQuery('.iconListItemsContainer').append(
                    '<li>'+
                        '<h3 class="handleHeader">'+iconListItemTextLimited+'<span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span> <span class="dashicons dashicons-admin-page slideDuplicateButton" style="float: right;" title="Duplicate"></span>  </h3>'+
                        '<div class="accordContentHolder">'+
                            '<label>List Text</label>'+
                            '<input type="text" class="iconListItemText" value="'+val['iconListItemText']+'" data-optname="iconListComplete.'+index+'.iconListItemText" > <br> <br>'+
                            '<label>Select Icon:  </label>'+
                            '<input  data-placement="bottomRight" class="icp pbIconListPicker iconListItemIcon" value="'+val['iconListItemIcon']+'" type="text" data-optname="iconListComplete.'+index+'.iconListItemIcon" /> <span class="input-group-addon" style="font-size: 16px;"></span> <br> <br> '+
                            '<label>Link : </label> '+
                            '<input type="url" class="iconListItemLink" value="'+val['iconListItemLink']+'" data-optname="iconListComplete.'+index+'.iconListItemLink" > <br> <br> '+
                            '<label>Open Link in :</label> '+
                            '<select class="iconListItemLinkOpen ililo-'+index+' " value="'+val['iconListItemLinkOpen']+'" data-optname="iconListComplete.'+index+'.iconListItemLinkOpen" > <option value="_blank">New Tab</option> <option value="_self">Same Tab</option> </select>'+
                        '</div>'+
                    '</li>'
                );
                jQuery('.ililo-'+index).val( val['iconListItemLinkOpen'] );
                jQuery( '.iconListItemsContainer' ).accordion( "refresh" );

            });

            jQuery('.pbIconListPicker').iconpicker({ });
            jQuery('.pbIconListPicker').on('iconpickerSelected',function(event){
              jQuery(this).val(event.iconpickerValue);
              jQuery(this).trigger('change');
            });
}

function renderImageSliderItemsList(pbSliderImagesURL,pbSliderContent){
            jQuery('.sliderImageSlidesContainer').html('');

            if (typeof(pbSliderContent[0]['imageSlideUrl']) !== 'undefined' ) {
                pbSliderImagesURL = pbSliderContent;
            }
            jQuery.each(pbSliderImagesURL,function(index, val){
                
                var slideCountA = index + 30;

                var slideImageUrl = val;
                if (typeof(val['imageSlideUrl']) !== 'undefined') {
                  slideImageUrl = val['imageSlideUrl'];
                }

                var isalt = ''; var istitle = '';
                if (typeof(pbSliderContent) == 'undefined') {
                    imageSlideHeading = '';
                    imageSlideDesc = '';
                    imageSlideButtonText = '';
                    imageSlideButtonURL = '';
                }else{
                    imageSlideHeading = pbSliderContent[index]['imageSlideHeading'];
                    imageSlideDesc = pbSliderContent[index]['imageSlideDesc'];
                    imageSlideButtonText = pbSliderContent[index]['imageSlideButtonText'];
                    imageSlideButtonURL = pbSliderContent[index]['imageSlideButtonURL'];

                    if ( typeof(pbSliderContent[index]['isalt']) == 'undefined' ) {
	                    pbSliderContent[index]['isalt'] = '';
	                    pbSliderContent[index]['istitle'] = '';
	                }

	                isalt = pbSliderContent[index]['isalt'];
	                istitle = pbSliderContent[index]['istitle'];

                }
                
                
                
                jQuery('.sliderImageSlidesContainer').append(
                    '<li> '+
                        '<h3 class="handleHeader widgetOpsAccordionHandle">Slide <span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span> <span class="dashicons dashicons-admin-page slideDuplicateButton" style="float: right;" title="Duplicate"></span>  </h3>'+
                        '<div class="accordContentHolder"> <br><br> '+
                            '<label>Slide Image :</label> '+
                            '<input id="image_location'+slideCountA+'" type="text" class="slideImgURL upload_image_button'+slideCountA+'" name="lpp_add_img_'+slideCountA+'" value="'+slideImageUrl+'" placeholder="Insert Image URL here" style="width:40%;" data-optname="pbSliderContent.'+index+'.imageSlideUrl"> '+
                            '<label></label> <input id="image_location'+slideCountA+'" type="button" class="upload_bg_btn_imageSlider" data-id="'+slideCountA+'" value="Upload" /> <br> <br> <br> <br> <br> <hr> <br> <br> '+
                            '<input type="hidden" value="'+isalt+'" class="isalt altTextField" data-optname="pbSliderContent.'+index+'.isalt">'+
                            '<input type="hidden" value="'+istitle+'" class="istitle titleTextField" data-optname="pbSliderContent.'+index+'.istitle"> <br>'+

                            '<label>Slide Heading :</label>'+
                            '<input type="text" class="imageSlideHeading" value="'+imageSlideHeading+'" data-optname="pbSliderContent.'+index+'.imageSlideHeading" > <br> <br> <br>'+
                            '<label>Slide Description :</label>'+
                            '<textarea class="imageSlideDesc" value="'+imageSlideDesc+'" data-optname="pbSliderContent.'+index+'.imageSlideDesc" >'+imageSlideDesc+'</textarea> <br> <br> <br>'+
                            '<label>Slide Button Text :</label>'+
                            '<input type="text" class="imageSlideButtonText" value="'+imageSlideButtonText+'" data-optname="pbSliderContent.'+index+'.imageSlideButtonText" > <br> <br> <br> '+
                            '<label>Slide Button URL :</label>'+
                            '<input type="url" class="imageSlideButtonURL" value="'+imageSlideButtonURL+'" data-optname="pbSliderContent.'+index+'.imageSlideButtonURL" > <br> <br> <br> '+
                        '</div> '+
                    '</li>'
                );

                jQuery( '.sliderImageSlidesContainer' ).accordion( "refresh" );
            });
}

function setValuesToImageSliderList(pbSliderContent){

            jQuery.each(pbSliderContent,function(index, val){
                
                var slideCountA = index + 30;

                if (typeof(pbSliderContent) == 'undefined') {
                    imageSlideHeading = '';
                    imageSlideDesc = '';
                    imageSlideButtonText = '';
                    imageSlideButtonURL = '';
                }else{
                    imageSlideHeading = pbSliderContent[index]['imageSlideHeading'];
                    imageSlideDesc = pbSliderContent[index]['imageSlideDesc'];
                    imageSlideButtonText = pbSliderContent[index]['imageSlideButtonText'];
                    imageSlideButtonURL = pbSliderContent[index]['imageSlideButtonURL'];
                }
                if ( typeof(pbSliderContent[index]['isalt']) == 'undefined' ) {
                    pbSliderContent[index]['isalt'] = '';
                    pbSliderContent[index]['istitle'] = '';
                }
                
                jQuery('[data-optname="pbSliderContent.'+index+'.imageSlideHeading"]').val(imageSlideHeading);
                jQuery('[data-optname="pbSliderContent.'+index+'.imageSlideDesc"]').val(imageSlideDesc);
                jQuery('[data-optname="pbSliderContent.'+index+'.imageSlideButtonText"]').val(imageSlideButtonText);
                jQuery('[data-optname="pbSliderContent.'+index+'.imageSlideButtonURL"]').val(imageSlideButtonURL);

                jQuery('[data-optname="pbSliderContent.'+index+'.isalt"]').val(pbSliderContent[index]['isalt']);
                jQuery('[data-optname="pbSliderContent.'+index+'.istitle"]').val(pbSliderContent[index]['istitle']);

            });
}


function renderImageGalleryImageList(allGalleryItems){
            if (typeof(allGalleryItems) == 'undefined' ) {
                return false;
            }

            jQuery('.customImageGalleryItems').html('');
            jQuery.each(allGalleryItems,function(index, val){
                var slideCountA = 4380 + index;

                if (typeof(val['gli']) == 'undefined') {
                    val['gli'] = '';
                }

                jQuery('.customImageGalleryItems').append(

                    '<li>'+
                        '<h3 class="handleHeader"> Image <span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span> <img src="'+val['gur']+'" style="width:20px; float:right; margin-right:10px;">  </h3>'+
                        '<div  class="accordContentHolder">'+

                            "<label>Select Image :</label>"+
                            '<input id="image_location'+slideCountA+'" type="text" class="gallItemUrl upload_image_button'+slideCountA+'"  name="lpp_add_img_'+slideCountA+'" value="'+val['gur']+'"  placeholder="Insert Video URL here" style="width:90%;" data-optname="gallItems.'+index+'.gur" />'+
                            "<label></label>"+
                            '<input id="image_location'+slideCountA+'" type="button" class="upload_bg_btn_imageSlider" data-id="'+slideCountA+'" value="Select" style="width:90%;" />'+
                            "<br><br><br><br><br><br><hr><br><br>"+

                            "<label> Image Link : </label>"+
                            "<input type='url' placeholder='' value='"+val['gli']+"' class='gallItemLink' data-optname='gallItems."+index+".gli' >"+
                            "<br><br><br><hr><br>"+

                            "<label> Title (Alt Text) : </label>"+
                            "<input type='text' placeholder='This is also alt text of image' value='"+val['gti']+"' class='gallItemTitle' data-optname='gallItems."+index+".gti' >"+
                            "<br><br><br><hr><br>"+

                            "<label> Caption : </label>"+
                            "<textarea class='gallItemCaption' value='"+val['gca']+"' data-optname='gallItems."+index+".gca' style='width:90%;' >"+val['gca']+"</textarea>"+
                            "<br><br><br>"+

                        '</div>'+
                    '</li>'

                );

                jQuery( '.customImageGalleryItems' ).accordion( "refresh" );
            });

}


function renderAccordionWidgetItems(accordionItems){

            jQuery('.accordionItemsContainer').html('');
            val = '';
            jQuery.each(accordionItems,function(index, val){

                var accordionItemsCount = index;
                var editorId = 'accordionEditor_'+accordionItemsCount;

                if (typeof(val['accoTitle']) == 'undefined' ) { val['accoTitle'] = ' ';}
                if (val['accoTitle'] == '') { val['accoTitle'] = ' '; }

                itemTextLimited  = val['accoTitle'].slice(0,22)+'...';

                try {
                    wp.editor.remove(editorId);
                } catch(e) {
                    console.log(e);
                }

                val['accContent'] = val['accContent'].replace(/"/g, "'");
                

                jQuery('.accordionItemsContainer').append(
                    '<li>'+
                        '<h3 class="handleHeader">Accordion '+itemTextLimited+
                            '<span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span>'+
                        '</h3>'+
                        '<div class="accordContentHolder">'+
                            '<label> Title  </label>'+
                            '<input style="width:80%;" type="text" class="accoTitle" data-optname="accordionItems.'+accordionItemsCount+'.accoTitle" value="'+val['accoTitle']+'">'+
                            '<br><br><br><br><hr><br>'+
                            '<textarea id="'+editorId+'"  class="accContent" data-optname="accordionItems.'+accordionItemsCount+'.accContent" value="'+val['accContent']+'" style="width:340px;"></textarea>'+
                        '</div>'+
                    '</li>'
                );


                try {
                    wp.editor.initialize(editorId,  { tinymce : pageBuilderApp.tinymce, quicktags: true, mediaButtons: true },  );

                    tinymce.editors[editorId].on('change', function (ed, e) {
                        pageBuilderApp.changedOpType = 'specific';
                        pageBuilderApp.changedOpName =  editorId;
                        var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
                        
                        jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

                        ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
                        currentEditableColId = jQuery('.currentEditableColId').val();
                        jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

                    });
                } catch(e) {
                    console.log(e);
                }

                    

                jQuery( '.accordionItemsContainer' ).accordion( "refresh" );

                if (val['accContent'] != '' && typeof(val['accContent']) != 'undefined') {

                    try {
                        tinyMCE.get(editorId).setContent(val['accContent']);
                    } catch(e) {
                        console.log(e);
                    }

                    jQuery('#'+editorId).val(val['accContent']);
                }
                

                
            });
}


function rendertabWidgetItems(tabItems){

            jQuery('.tabItemsContainer').html('');
            jQuery.each(tabItems,function(index, val){

                var tabItemsCount = index;
                var editorId = 'tabEditor_'+tabItemsCount;

                itemTextLimited  = val['title'].slice(0,22)+'...';
                wp.editor.remove(editorId);

                val['content'] = val['content'].replace(/"/g, "'");

                jQuery('.tabItemsContainer').append(
                    '<li>'+
                        '<h3 class="handleHeader">Tab '+itemTextLimited+
                            '<span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span>'+
                        '</h3>'+
                        '<div class="accordContentHolder">'+
                            '<label> Title  </label>'+
                            '<input style="width:80%;" type="text" class="title" data-optname="tabItems.'+tabItemsCount+'.title" value="'+val['title']+'">'+
                            '<br><br><br><br><hr><br>'+
                            '<label> Icon  </label>'+
                            '<input  data-placement="bottomRight" class="icp pbIconListPicker tabItemsIcon" value="'+val['icon']+'" type="text" data-optname="tabItems.'+tabItemsCount+'.icon" style="width:95px;" /> <span class="input-group-addon" style="font-size: 14px !important;"></span> <br> <br> '+
                            '<br><hr><br>'+
                            '<textarea id="'+editorId+'"  class="content" data-optname="tabItems.'+tabItemsCount+'.content" value="'+val['content']+'" style="width:340px;" ></textarea>'+
                        '</div>'+
                    '</li>'
                );

                jQuery('.pbIconListPicker').iconpicker({ });
                jQuery('.pbIconListPicker').on('iconpickerSelected',function(event){
                  jQuery(this).val(event.iconpickerValue);
                  jQuery(this).trigger('change');
                });

                wp.editor.initialize(editorId,  { tinymce : pageBuilderApp.tinymce, quicktags: true, mediaButtons: true },  );

                tinymce.editors[editorId].on('change', function (ed, e) {
                    pageBuilderApp.changedOpType = 'specific';
                    pageBuilderApp.changedOpName =  editorId;
                    var that = jQuery('.closeWidgetPopup').attr('data-CurrWidget');
                    
                    jQuery('div[data-saveCurrWidget="'+that+'"]').trigger('click');

                    ColcurrentEditableRowID = jQuery('.ColcurrentEditableRowID').val();
                    currentEditableColId = jQuery('.currentEditableColId').val();
                    jQuery('section[rowid="'+ColcurrentEditableRowID+'"]').children('.ulpb_column_controls'+currentEditableColId).children('#editColumnSaveWidget').trigger('click');

                });

                jQuery( '.tabItemsContainer' ).accordion( "refresh" );

                if (val['content'] != '' && typeof(val['content']) != 'undefined') {
                    tinyMCE.get(editorId).setContent(val['content']);
                    jQuery('#'+editorId).val(val['content']);
                }
                

                
            });
}


function renderNavBuilderItems(navItems){


    jQuery('.customNavItemsContainer').html('');
    jQuery.each(navItems,function(index, val){

        if(val['cnilab'] == ''){
            val['cnilab'] = ' ';
        }

        val['cnilab'] = val['cnilab'].replace("'", '');
        
        val['cnilab'] = val['cnilab'].replaceAll("$", '');

        var menuItemTitleEl = jQuery(val['cnilab']);

        menuItemTitleEl = menuItemTitleEl.text();
        if (menuItemTitleEl == '') {
            menuItemTitleEl = val['cnilab'];
        }

        if (val['cnilab'].length > 20 ) {
            menuItemTitleEl  = val['cnilab'].slice(0,20)+'...';
        }
       

        jQuery('.customNavItemsContainer').append(

            '<li>'+
                '<h3 class="handleHeader">Menu Item - '+menuItemTitleEl+' <span class="dashicons dashicons-trash slideRemoveButton" style="float: right;"></span> </h3>'+
                '<div  class="accordContentHolder">'+
                    '<label> Link Label :</label>'+
                    "<input type='text' style='width:95%;' class='cnilab' value='"+val['cnilab']+"' data-optname='navItems."+index+".cnilab' > <br> <br> <br> <br> <br> "+
                    '<label> Link URL :</label>'+
                    "<input type='text' style='width:95%;' class='cniurl' value='"+val['cniurl']+"' data-optname='navItems."+index+".cniurl' > <br> <br> <br> <br> <br>"+
                '</div>'+ 
            '</li>'

        );
        jQuery( '.customNavItemsContainer' ).accordion( "refresh" );
    });

}


function isUndoAvailable(){
	if (stackUndo.length > 0) {
		return true;
	}
	
	return false;
}

function isRedoAvailable(){
	if (stackRedo.length > 0) {
		return true;
	}

	return false;
}


function setUndoRedoOptionToWidget(undoneChange,isUndo,isRedo){

	rowID = undoneChange['thisModelElId'];
	undoneChange['thisWidgetId'] = parseInt(undoneChange['thisWidgetId']);

	try {
		jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery("#"+rowID).offset().top - 150
	    }, 100);
	} catch(e) {
		console.log(e);
	}

	if (undoneChange['changedOpName'] == "widgetPbFbFormFeilds") {
		renderFormBuilderFieldsList(undoneChange['changedOpValue']);
		undoneChange['changedOpName'] = 'slideListEdit';
	}

	if (undoneChange['changedOpName'] == "iconListComplete") {
		renderIconListItemsList(undoneChange['changedOpValue']);
		undoneChange['changedOpName'] = 'slideListEdit';
	}

    if (undoneChange['changedOpName'] == "navItems") {
        renderNavBuilderItems(undoneChange['changedOpValue']);
        undoneChange['changedOpName'] = 'slideListEdit';
    }

    if (undoneChange['changedOpName'] == "pbSliderContent") {
        if ( typeof(undoneChange['changedOpValue'][0]['imageSlideUrl']) != 'undefined' ) {
            renderImageSliderItemsList(false,undoneChange['changedOpValue']);
        }else{
            
            var thisRowCid = jQuery('#'+rowID).parent('li').attr('data-model-cid');
            var thisRowModel = pageBuilderApp.rowList.get(thisRowCid);

            var pbSliderImagesURL = thisRowModel.attributes[undoneChange['thisColId']]['colWidgets'][undoneChange['thisWidgetId']]['widgetImageSlider']['pbSliderImagesURL'];
            renderImageSliderItemsList(pbSliderImagesURL,undoneChange['changedOpValue']);

        }
        
        undoneChange['changedOpName'] = 'slideListEdit';
    }


    if (undoneChange['changedOpName'] == "gallItems") {
        renderImageGalleryImageList(undoneChange['changedOpValue']);
        undoneChange['changedOpName'] = 'slideListEdit';
    }

    if (undoneChange['changedOpName'] == "widgetTextContent") {

        var wlteditorID = "widgetTextContent";
        if (jQuery('#wp-'+wlteditorID+'-wrap').hasClass("tmce-active"))
            tinyMCE.get(wlteditorID).setContent(undoneChange['changedOpValue']);
        else
            jQuery('#'+wlteditorID).val(undoneChange['changedOpValue']);

    }

	

	pageBuilderApp.changedOpName = undoneChange['changedOpName'];
	pageBuilderApp.changedOpType = undoneChange['changedOpType'];
	
	pageBuilderApp.currentlyEditedWidgId = undoneChange['thisWidgetId'];
	pageBuilderApp.changeFromUndoAction = isUndo;
	pageBuilderApp.changeFromRedoAction = isRedo;

	jQuery('[data-optname="'+undoneChange['changedOpName']+'"]').val(undoneChange['changedOpValue']);

	if ( undoneChange['changedOpName'].indexOf('color') != -1) {
		jQuery('[data-optname="'+undoneChange['changedOpName']+'"]').spectrum( 'set', undoneChange['changedOpValue'] );
	}

	jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.editColumn').trigger('click');
    jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.thisColumnWidgetsTabTrigger').trigger('click');
    jQuery('.edit_column').hide(0);
    jQuery('.ulpb_column_controls').hide(0);

    jQuery('#widgets li:nth-child('+(undoneChange['thisWidgetId']+1)+')').children().children('#widgetSave').trigger('click');

    jQuery('#'+rowID).children('.ulpb_column_controls'+undoneChange['thisColId']).children('#editColumnSaveWidget').trigger('click');



}

function setUndoRedoSpecialOptionToWidget(undoneChange,isUndo,isRedo){
	
	//console.log('setUndoRedoSpecialOptionToWidget');
	rowID = undoneChange['thisModelElId'];

	try {
		jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery("#"+rowID).offset().top - 150
	    }, 100);
	} catch(e) {
		console.log(e);
	}


	pageBuilderApp.changedOpName = undoneChange['changedOpName'];
	pageBuilderApp.changedOpType = undoneChange['changedOpType'];
	pageBuilderApp.changeFromUndoAction = isUndo;
	pageBuilderApp.changeFromRedoAction = isRedo;
	undoneChange['thisWidgetId'] = parseInt(undoneChange['thisWidgetId']);

	if (undoneChange['specialAction'] == 'inlineOps') {
		pageBuilderApp.copiedInlineOps = undoneChange['changedOpValue'];

		jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.editColumn').trigger('click');
		jQuery('.edit_column').hide(0);
	    jQuery('.ulpb_column_controls').hide(0);

		jQuery('#widgets li:nth-child('+(undoneChange['thisWidgetId']+1)+')').children().children('.wdt-edit-controls').children('#updateInlineTextChanges').trigger('click');
	}

	if (undoneChange['specialAction'] == 'widgetTemplate') {

		pageBuilderApp.thisUndoRedoProps = undoneChange;

		jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.editColumn').trigger('click');
	    jQuery('.edit_column').hide(0);
	    jQuery('.ulpb_column_controls').hide(0);

		jQuery('#widgets li:nth-child('+(undoneChange['thisWidgetId']+1)+')').children().children('.wdt-edit-controls').children('#addWidgetTemplateStateToUndoRedo').trigger('click');

		jQuery('#'+rowID).children('.ulpb_column_controls'+undoneChange['thisColId']).children('#editColumnSaveWidget').trigger('click');

	}


	if (undoneChange['specialAction'] == 'widgetOps') {

		pageBuilderApp.copiedWidgOps = undoneChange['changedOpValue'];

		jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.widget-'+undoneChange['thisWidgetId']).children('.widgetPasteHandle').trigger('click');

		if (isUndo == true) {

		}

		if (isRedo == true) {

		}
				
	}


	if (undoneChange['specialAction'] == 'delete') {

		if (isUndo == true) {
			
			pageBuilderApp.isWidgetDeletAction = true;
			pageBuilderApp.isDefaultWidget = true;
			jQuery('.draggedWidgetAttributes').val(undoneChange['changedOpValue']);
			jQuery('.widgetDroppedAtIndex').val(undoneChange['thisWidgetId']);
			jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.wdgt-dropped').trigger('click');

		}

		if (isRedo == true) {

			pageBuilderApp.dontSendToStack = true;

			jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.editColumn').trigger('click');
			jQuery('.edit_column').hide(0);
		    jQuery('.ulpb_column_controls').hide(0);

			setTimeout(function() {
			  jQuery('#widgets li:nth-child('+(undoneChange['thisWidgetId']+1)+')').children().children('.wdt-edit-controls').children('#widgetDelete').trigger('click');
			}, 50 );

			addChangeToUndo(undoneChange);
		    
		}
				
	}


	if (undoneChange['specialAction'] == 'add') {

		if (isUndo == true) {

			pageBuilderApp.dontSendToStack = true;
			jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.editColumn').trigger('click');
			jQuery('.edit_column').hide(0);
		    jQuery('.ulpb_column_controls').hide(0);

			jQuery('#widgets li:nth-child('+(undoneChange['thisWidgetId']+1)+')').children().children('.wdt-edit-controls').children('#widgetDelete').trigger('click');

			addChangeToRedo(undoneChange);

		}

		if (isRedo == true) {

			jQuery('.draggedWidgetAttributes').val(undoneChange['changedOpValue']);
			jQuery('.widgetDroppedAtIndex').val(undoneChange['thisWidgetId']);
			jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.wdgt-dropped').trigger('click');

		}
				
	}



	if (undoneChange['specialAction'] == 'dragAdd') {

		if (isUndo == true) {

			pageBuilderApp.dontSendToStack = true;
			jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.editColumn').trigger('click');
			jQuery('.edit_column').hide(0);
		    jQuery('.ulpb_column_controls').hide(0);

			jQuery('#widgets li:nth-child('+(undoneChange['thisWidgetId']+1)+')').children().children('.wdt-edit-controls').children('#widgetDelete').trigger('click');

			addChangeToRedo(undoneChange);

		}

		if (isRedo == true) {

			jQuery('.draggedWidgetAttributes').val(undoneChange['changedOpValue']);
			jQuery('.widgetDroppedAtIndex').val(undoneChange['thisWidgetId']);
			jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.wdgt-dropped').trigger('click');

		}
				
	}


	if (undoneChange['specialAction'] == 'dragDelete') {

		if (isUndo == true) {
			
			pageBuilderApp.isWidgetDeletAction = true;
			pageBuilderApp.dontSendToStack = true;
			jQuery('.draggedWidgetAttributes').val(undoneChange['changedOpValue']);
			jQuery('.widgetDroppedAtIndex').val(undoneChange['thisWidgetId']);
			jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.wdgt-dropped').trigger('click');

			addChangeToRedo(undoneChange);

		}

		if (isRedo == true) {

			pageBuilderApp.dontSendToStack = true;

			jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.editColumn').trigger('click');
			jQuery('.edit_column').hide(0);
		    jQuery('.ulpb_column_controls').hide(0);

			jQuery('#widgets li:nth-child('+(undoneChange['thisWidgetId']+1)+')').children().children('.wdt-edit-controls').children('#widgetDelete').trigger('click');

			addChangeToUndo(undoneChange);
			popb_redo();
		    
		}
				
	}
	
	pageBuilderApp.changeFromUndoAction = false;
    pageBuilderApp.changeFromRedoAction = false;


}


function setUndoRedoOptionToColumn(undoneChange,isUndo,isRedo){

	rowID = undoneChange['thisModelElId'];

	try {
		jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery("#"+rowID).offset().top - 150
	    }, 100);
	} catch(e) {
		console.log(e);
	}

	pageBuilderApp.changedColOpName = undoneChange['changedOpName'];
	pageBuilderApp.changeFromUndoAction = isUndo;
	pageBuilderApp.changeFromRedoAction = isRedo;

	jQuery('#'+undoneChange['thisModelElId']+'-'+undoneChange['thisColId']).children('.editColumn').trigger('click');
	jQuery('.edit_column').hide(0);
    jQuery('.ulpb_column_controls').hide(0);

	jQuery('[data-optname="'+undoneChange['changedOpName']+'"]').val(undoneChange['changedOpValue']);

	if ( undoneChange['changedOpName'].indexOf('color') != -1) {
		if (undoneChange['changedOpValue'] == '') {
			undoneChange['changedOpValue'] = 'transparent';
		}
		jQuery('[data-optname="'+undoneChange['changedOpName']+'"]').spectrum( 'set', undoneChange['changedOpValue'] );
	}

	jQuery('section[rowid="'+rowID+'"]').children('.ulpb_column_controls'+undoneChange['thisColId']).children('#editColumnSave').trigger('click');

	pageBuilderApp.undoRedoColDragWidth = false;

	if (typeof(undoneChange['specialAction']) != 'undefined') {
		if (undoneChange['specialAction'] == 'colWidth') {
			if ( isUndo && isUndoAvailable() ) {
				pageBuilderApp.undoRedoColDragWidth = true;
				popb_undo();
			}
			if (isRedo && isRedoAvailable() ) {
				pageBuilderApp.undoRedoColDragWidth = true;
				popb_redo();
			}
		}
	}


}


function setUndoRedoSpecialOptionToCol(undoneChange,isUndo,isRedo){
	
	//console.log('setUndoRedoSpecialOptionToCol');
	rowID = undoneChange['thisModelElId'];

	try {
		jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery("#"+rowID).offset().top - 150
	    }, 100);
	} catch(e) {
		console.log(e);
	}

	pageBuilderApp.changeFromUndoAction = isUndo;
	pageBuilderApp.changeFromRedoAction = isRedo;

	if (undoneChange['specialAction'] == 'delete') {
		
		if (isUndo == true) {
			pageBuilderApp.undoRedoDeletedCol = undoneChange;
			jQuery('section[rowid="'+rowID+'"]').children('#ulpb_row_controls').children('#reAddDeletedColumns').trigger('click');

			jQuery('.ulpb_row_controls').css('display','none');
		}

		if (isRedo == true) {
			jQuery('#'+rowID+'-column'+undoneChange['thisModelIndex']).children('#deleteColumns').trigger('click');
			jQuery('.ulpb_row_controls').css('display','none');
		}

	}

	if (undoneChange['specialAction'] == 'flip') {
		
		if (isUndo == true) {
			jQuery('#'+rowID+'-column'+undoneChange['thisModelIndex']).children('#flipColumns').trigger('click');
		}

		if (isRedo == true) {
			jQuery('#'+rowID+'-column'+undoneChange['thisModelIndex']).children('#flipColumns').trigger('click');
		}

	}

	if (undoneChange['specialAction'] == 'duplicate') {
		
		if (isUndo == true) {
			pageBuilderApp.undeRedoActionDuplicateCol = true;
			jQuery('#'+rowID+'-column'+undoneChange['thisModelIndex']).children('#deleteColumns').trigger('click');
			jQuery('.ulpb_row_controls').css('display','none');
			sendDataBackToUndoStack(undoneChange);
		}

		if (isRedo == true) {
			pageBuilderApp.undoRedoDeletedCol = undoneChange;
			pageBuilderApp.undeRedoActionDuplicateCol = true;
			jQuery('section[rowid="'+rowID+'"]').children('#ulpb_row_controls').children('#reAddDeletedColumns').trigger('click');
			sendDataBackToUndoStack(undoneChange);
			jQuery('.ulpb_row_controls').css('display','none');
		}

	}

	if (undoneChange['specialAction'] == 'colOps') {

		rowID = undoneChange['thisModelElId'];
		
		pageBuilderApp.copiedColOps = JSON.stringify(undoneChange['thisModelVal']);

		jQuery('#'+rowID+'-column'+undoneChange['thisModelIndex']).children('#pasteColumnOps').trigger('click');

	}
	

}


function setUndoRedoOptionToRow(undoneChange,isUndo,isRedo){

	rowID = undoneChange['thisModelElId'];

	jQuery([document.documentElement, document.body]).animate({
        scrollTop: jQuery("#"+rowID).offset().top - 150
    }, 100);

	pageBuilderApp.changedRowOpName = undoneChange['changedOpName'];
	pageBuilderApp.changeFromUndoAction = isUndo;
	pageBuilderApp.changeFromRedoAction = isRedo;

	jQuery('[data-optname="'+undoneChange['changedOpName']+'"]').val(undoneChange['changedOpValue']);

	if ( undoneChange['changedOpName'].indexOf('color') != -1) {
		jQuery('[data-optname="'+undoneChange['changedOpName']+'"]').spectrum( 'set', undoneChange['changedOpValue'] );
	}

	jQuery('section[rowid="'+rowID+'"]').children('#ulpb_row_controls').children('#editRowSave').trigger('click');
	jQuery('section[rowid="'+rowID+'"]').children('#ulpb_row_controls').css('display','none');
	jQuery('.edit_row').hide(0);

	pageBuilderApp.changeFromUndoAction = false;
	pageBuilderApp.changeFromRedoAction = false;
		
}


function setUndoRedoSpecialOptionToRow(undoneChange,isUndo,isRedo){
	
	//console.log('setUndoRedoSpecialOptionToRow');
	rowID = undoneChange['thisModelElId'];
	pageBuilderApp.changeFromUndoAction = isUndo;
	pageBuilderApp.changeFromRedoAction = isRedo;

	if (undoneChange['specialAction'] == 'rowSort') {
		
		if (isUndo == true) {
			
			var movedModelAttrs = pageBuilderApp.rowList.at(undoneChange['thisModelVal']);
			var movedModelAttrsString = JSON.stringify(movedModelAttrs);

			movedModelAttrs.destroy();
            jQuery(movedModelAttrs.el).remove();

			pageBuilderApp.rowList.add( JSON.parse(movedModelAttrsString) ,{at: undoneChange['thisModelIndex']} );
			addChangeToRedo(undoneChange);

			pageBuilderApp.changeFromUndoAction = false;
		}

		if (isRedo == true) {
			
			var movedModelAttrs = pageBuilderApp.rowList.at(undoneChange['thisModelIndex']);
			var movedModelAttrsString = JSON.stringify(movedModelAttrs);

			movedModelAttrs.destroy();
            jQuery(movedModelAttrs.el).remove();

			pageBuilderApp.rowList.add( JSON.parse(movedModelAttrsString) ,{at: undoneChange['thisModelVal']} );
			addChangeToUndo(undoneChange);

			pageBuilderApp.changeFromRedoAction = false;

		}

	}


	if (undoneChange['specialAction'] == 'delete') {
		
		if (isUndo == true) {
			pageBuilderApp.rowList.add( undoneChange['thisModelVal'] ,{at: undoneChange['thisModelIndex']});
			addChangeToRedo(undoneChange);
		}

		if (isRedo == true) {
			try {
				jQuery([document.documentElement, document.body]).animate({
			        scrollTop: jQuery("#"+rowID).offset().top - 150
			    }, 100);
			} catch(e) {
				// statements
				console.log(e);
			}
			var deletedModel = pageBuilderApp.rowList.at(undoneChange['thisModelIndex']);
			pageBuilderApp.rowList.remove(deletedModel);
			addChangeToUndo(undoneChange);
		}

	}

	if (undoneChange['specialAction'] == 'duplicate') {
		
		if (isUndo == true) {
			var duplicateModel = pageBuilderApp.rowList.at(undoneChange['thisModelIndex']);
			pageBuilderApp.rowList.remove(duplicateModel);
			duplicateModel.destroy();
            jQuery(duplicateModel.el).remove();

			addChangeToRedo(undoneChange);
		}

		if (isRedo == true) {
			pageBuilderApp.rowList.add( undoneChange['thisModelVal'] ,{at: undoneChange['thisModelIndex']});
			addChangeToUndo(undoneChange);
		}

	}


	if (undoneChange['specialAction'] == 'NewGlobalRow') {
		
		if (isUndo == true) {
			var duplicateModel = pageBuilderApp.rowList.at(undoneChange['thisModelIndex']);
			pageBuilderApp.rowList.remove(duplicateModel);
			addChangeToRedo(undoneChange);
		}

		if (isRedo == true) {

			selectGlobalRowToInsert = undoneChange['thisModelVal'];
			if (selectGlobalRowToInsert != '') {
                getGlobalRowDataFromDb(selectGlobalRowToInsert);
            }
                
            retrievedGlobalRowAttributes = jQuery('.globalRowRetrievedAttributes').val();
            retrievedGlobalRowAttributes = JSON.parse(retrievedGlobalRowAttributes);

            if (retrievedGlobalRowAttributes != '') {
              pageBuilderApp.rowList.add( retrievedGlobalRowAttributes , {at: undoneChange['thisModelIndex'] } );
            }

			addChangeToUndo(undoneChange);
		}

	}

	if (undoneChange['specialAction'] == 'sectionOps') {

		rowID = undoneChange['thisModelElId'];
		
		pageBuilderApp.copiedSecOps = JSON.stringify(undoneChange['thisModelVal']);

		jQuery('section[rowid="'+rowID+'"]').children('.rowAllEditBtnContainer').children('#pasteSectionOps').trigger('click');

		jQuery('.edit_row').hide(0);
		jQuery('.ulpb_row_controls').css('display','none');

	}

	pageBuilderApp.changeFromUndoAction = false;
	pageBuilderApp.changeFromRedoAction = false;
		
	try {
		jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery("#"+rowID).offset().top - 150
	    }, 100);
	} catch(e) {
		// statements
		console.log(e);
	}
	

}




function sendDataBackToUndoStack(thisChangeRedoProps){

	//console.log('sendDataBackToUndoStack');
	if (thisChangeRedoProps['changedOpName'] != '' && thisChangeRedoProps['changedOpName'] != ' ') {
        
    	if (pageBuilderApp.changeFromUndoAction != true) {
          
        	addChangeToUndo(thisChangeRedoProps);
        	if (pageBuilderApp.changeFromRedoAction != true ) {
        		emptyRedoStackOnNewChange();
          	}
        
        }

        if (pageBuilderApp.changeFromUndoAction == true && pageBuilderApp.changeFromRedoAction == false) {
        	addChangeToRedo(thisChangeRedoProps);
        }

    }

    pageBuilderApp.changeFromUndoAction = false;
    pageBuilderApp.changeFromRedoAction = false;
    pageBuilderApp.changedRowOpName = '';
    pageBuilderApp.prevStateOption = false;
    pageBuilderApp.prevWidgetStateOption = false;

    if ( ! isUndoAvailable() ) {
        jQuery('#pbbtnUndo').css('background','#c5c5c5');
    }else{
        jQuery('#pbbtnUndo').css('background','#e3e3e3');
    }

    if ( ! isRedoAvailable() ) {
        jQuery('#pbbtnRedo').css('background','#c5c5c5');
    }else{
        jQuery('#pbbtnRedo').css('background','#e3e3e3');
    }

}

function addChangeToUndo(changedOptionProps){

	if (stackUndo.length >= 0) {

		var lasStackUndoItem = stackUndo[stackUndo.length - 1];
		if ( JSON.stringify(lasStackUndoItem) == JSON.stringify(changedOptionProps) ) {

		}else{
			stackUndo.push(changedOptionProps);

            if(stackUndo.length > 50){
                stackUndo.shift();
            }
			//console.log('addChangeToUndo trigger');
			//console.log(stackUndo);
		}

	}
}

function addChangeToRedo(propsFromUndo){

	if (stackRedo.length >= 0) {
		var lasstackRedoItem = stackRedo[stackRedo.length];
		if ( JSON.stringify(lasstackRedoItem) == JSON.stringify(propsFromUndo) ) {

		}else{
			stackRedo.push(propsFromUndo);
			//console.log('addChangeToRedo trigger');
			//console.log(stackRedo);
		}
	}

}

function emptyRedoStackOnNewChange(){
    
    //console.log('emptyRedoStackOnNewChange trigger')
	stackRedo = [];

    if ( ! isRedoAvailable() ) {
        jQuery('#pbbtnRedo').css('background','#c5c5c5');
    }else{
        jQuery('#pbbtnRedo').css('background','#e3e3e3');
    }

}

function popb_undo(){

	var undoneChange = stackUndo.pop();
	//console.log(undoneChange);

 	if (typeof(undoneChange) != 'undefined') {
 		
 		switch (undoneChange['changeModelType']) {
 			case 'row':
 				setUndoRedoOptionToRow(undoneChange,true,false);
 			break;
 			case 'rowSpecialAction':
 				setUndoRedoSpecialOptionToRow(undoneChange,true,false);
 			break;
 			case 'column':
 				setUndoRedoOptionToColumn(undoneChange,true,false);
 			break;
 			case 'colSpecialAction':
 				setUndoRedoSpecialOptionToCol(undoneChange,true,false);
 			break;
 			case 'widget':
 				setUndoRedoOptionToWidget(undoneChange,true,false);
 			break;
 			case 'widgetSpecialAction':
 				setUndoRedoSpecialOptionToWidget(undoneChange,true,false);
 			break;
 			default:
 				// statements_def
 			break;
 		}

 		resizeWindowClose();
 	}

    if ( ! isUndoAvailable() ) {
        jQuery('#pbbtnUndo').css('background','#c5c5c5');
    }else{
        jQuery('#pbbtnUndo').css('background','#e3e3e3');
    }

    if ( ! isRedoAvailable() ) {
        jQuery('#pbbtnRedo').css('background','#c5c5c5');
    }else{
        jQuery('#pbbtnRedo').css('background','#e3e3e3');
    }

}

function popb_redo(){

 	var redoneChange = stackRedo.pop();
 	
	if (typeof(redoneChange) != 'undefined') {

 		switch (redoneChange['changeModelType']) {
 			case 'row':
 				setUndoRedoOptionToRow(redoneChange,false,true);
 			break;
 			case 'rowSpecialAction':
 				setUndoRedoSpecialOptionToRow(redoneChange,false,true);
 			break;
 			case 'column':
 				setUndoRedoOptionToColumn(redoneChange,false,true);
 			break;
 			case 'colSpecialAction':
 				setUndoRedoSpecialOptionToCol(redoneChange,false,true);
 			break;
 			case 'widget':
 				setUndoRedoOptionToWidget(redoneChange,false,true);
 			break;
 			case 'widgetSpecialAction':
 				setUndoRedoSpecialOptionToWidget(redoneChange,false,true);
 			break;
 			default:
 				// statements_def
 			break;
 		}

 		//console.log(redoneChange);
        resizeWindowClose();
 	}


    if ( ! isRedoAvailable() ) {
        jQuery('#pbbtnRedo').css('background','#c5c5c5');
    }else{
        jQuery('#pbbtnRedo').css('background','#e3e3e3');
    }

    if ( ! isUndoAvailable() ) {
        jQuery('#pbbtnUndo').css('background','#c5c5c5');
    }else{
        jQuery('#pbbtnUndo').css('background','#e3e3e3');
    }

 	//console.log('stackUndo');
 	//console.log(stackUndo);

}