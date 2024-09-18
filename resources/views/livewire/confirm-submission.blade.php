<style type="text/css">
    .bg_blue {
        background-color: #003399;
        border-radius: 12px;
    }

    .bg_blue h2 {
        color: #fff;
        font-weight: 600;
        margin: 0px;
        font-size: 3vh;
    }

    .self {
        float: left;
        font-weight: 700;
        margin-right: 1%;
        padding-top: 1%;
        margin-top: 1%;
    }
</style>
<div class="modal modal-xl fade" wire:ignore.self id="confirm-submit" tabindex="-1" aria-labelledby="confirmSubmitLabel"
    data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmSubmitLabel">Confirm Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <h4 style="text-align: center;">Are you sure you want to submit the following details?</h4>
                    <div class="section1">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="modal_field_name"></div>
                                <div class="modal_field_value" id="">
                                    <img src="{{ url('/')}}/bower_components/Emblem_of_West_Bengal.png" width="180px"
                                        height="200px">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div align="center">
                                    <div class="modal_field_name"></div>
                                    <div class="modal_field_value" id="">
                                        <p>
                                        <h2>Government of West Bengal</h2>
                                        </p>
                                    </div>
                                    <p>
                                    <h2>Jai Bangla Pension Scheme</h2>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="modal_field_name"></div>
                                <div class="modal_field_value" id=""> <img id="passport_image_view_modal" src="#" alt=""
                                        width="200px" height="200px" /></div>
                            </div>
                        </div>
                        <div class="section1">
                            <div class="row color1">
                                <div class="col-md-12">
                                    <h2>Personal Details</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal_field_name">Name:</div>
                                    <div class="modal_field_value" id="name_modal"></div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="modal_field_name" style="margin-right:6%;">Gender:</div>
                                    <div class="modal_field_value" id="gender_modal"></div>
                                </div>

                                <div class="col-md-6">
                                    <div class="modal_field_name" style="margin-right:6%;">Date of Birth:</div>
                                    <div class="modal_field_value" id="dob_modal"></div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal_field_name">Father's Name:</div>
                                    <div class="modal_field_value" id="father_name_modal"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal_field_name">Mother's Name:</div>
                                    <div class="modal_field_value" id="mother_name_modal"></div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal_field_name">Spouse Name, if applicable:</div>
                                    <div class="modal_field_value" id=spouse_name_modal></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="modal_field_name">Marital Status:</div>
                                    <div class="modal_field_value" id=marital_status_modal></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="modal_field_name">Caste:</div>
                                    <div class="modal_field_value" id=caste_category_modal></div>
                                </div>
                            </div>

                        </div>

                        <div class="section1">
                            <div class="row color1">
                                <div class="col-md-12">
                                    <h2>Personal Identification Number(S)</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="modal_field_name">Digital Ration Card No.:</div>
                                    <div class="modal_field_value" id="ration_card_no_modal"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="modal_field_name">Aadhaar No., if available:</div>
                                    <div class="modal_field_value" id="aadhar_no_modal"></div>
                                </div>

                                <div class="col-md-6">
                                    <div class="modal_field_name">EPIC/Voter Id.No.:</div>
                                    <div class="modal_field_value" id="epic_voter_id_modal"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal_field_name">PAN, if available:</div>
                                    <div class="modal_field_value" id="pan_no_modal"></div>
                                </div>
                            </div>
                        </div>
                        <div class="section1 ">
                            <div class="row color1">
                                <div class="col-md-12">
                                    <h2>Contact Details</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="">Permanent Address</label>

                                </div>
                            </div>

                            <div class="row address" id="per_address_modal">
                                <div class="col-md-12">
                                    <div class="modal_field_name">State:</div>
                                    <div class="modal_field_value" id="state_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">District:</div>
                                    <div class="modal_field_value" id="district_modal"></div>
                                </div>

                                <div class="col-md-12">
                                    <div class="modal_field_name">Assembly Constitution:</div>
                                    <div class="modal_field_value" id="asmb_cons_modal"></div>
                                </div>

                                <div class="col-md-12">
                                    <div class="modal_field_name">Police Station:</div>
                                    <div class="modal_field_value" id="police_station_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">Block/Municipality/Corp:</div>
                                    <div class="modal_field_value" id="block_modal"></div>
                                </div>

                                <div class="col-md-12">
                                    <div class="modal_field_name">GP/Ward No.:</div>
                                    <div class="modal_field_value" id="gp_ward_modal"></div>
                                </div>



                                <div class="col-md-12">
                                    <div class="modal_field_name">Village/Town/City:</div>
                                    <div class="modal_field_value" id="village_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">House/Premise No.:</div>
                                    <div class="modal_field_value" id="house_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">Post Office:</div>
                                    <div class="modal_field_value" id="post_office_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">Pin Code:</div>
                                    <div class="modal_field_value" id="pin_code_modal"></div>
                                </div>

                            </div>
                            <br />
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="">Current Address</label>

                                </div>
                                <br />
                                <div class="row address" id="cur_address_modal">
                                    <div class="col-md-12">
                                        <div class="modal_field_name">State:</div>
                                        <div class="modal_field_value" id="state_cur_modal"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal_field_name">District:</div>
                                        <div class="modal_field_value" id="district_cur_modal"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="modal_field_name">Assembly Constitution:</div>
                                        <div class="modal_field_value" id="asmb_cons_cur_modal"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="modal_field_name">Police Station:</div>
                                        <div class="modal_field_value" id="police_station_cur_modal"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal_field_name">Block/Municipality/Corp:</div>
                                        <div class="modal_field_value" id="block_cur_modal"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="modal_field_name">GP/Ward No.:</div>
                                        <div class="modal_field_value" id="gp_ward_cur_modal"></div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="modal_field_name">Village/Town/City:</div>
                                        <div class="modal_field_value" id="village_cur_modal"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal_field_name">House/Premise No.:</div>
                                        <div class="modal_field_value" id="house_cur_modal"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal_field_name">Post Office:</div>
                                        <div class="modal_field_value" id="post_office_cur_modal"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal_field_name">Pin Code:</div>
                                        <div class="modal_field_value" id="pin_code_cur_modal"></div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="modal_field_name">Number of years Dwelling in WB:</div>
                                        <div class="modal_field_value" id="residency_period_modal"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="modal_field_name">Mobile Number:</div>
                                        <div class="modal_field_value" id="mobile_no_modal"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal_field_name">Email Id., if available:</div>
                                        <div class="modal_field_value" id="email_modal"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="section1">
                            <div class="row color1">
                                <div class="col-md-12">
                                    <h2>Land Details (In case of Dwelling House)</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal_field_name">Name of the Mouza:</div>
                                    <div class="modal_field_value" id="mouza_name_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">J.L.No:</div>
                                    <div class="modal_field_value" id="land_jlno_modal"></div>
                                </div>

                                <div class="col-md-12">
                                    <div class="modal_field_name">Khatian No:</div>
                                    <div class="modal_field_value" id="khatian_no_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">Plot No:</div>
                                    <div class="modal_field_value" id="plot_no_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">Area:</div>
                                    <div class="modal_field_value" id="land_area_modal"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">In the Name of:</div>
                                    <div class="modal_field_value" id="land_holdername_modal"></div>
                                </div>
                            </div>
                        </div>

                        <div class="section1">
                            <div class="row color1">
                                <div class="col-md-12">
                                    <h2>Bank Account Details</h2>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="modal_field_name">Bank Name:</div>
                                    <div class="modal_field_value" id="name_of_bank_modal"></div>
                                </div>

                                <div class="col-md-12">
                                    <div class="modal_field_name">Bank Branch Name:</div>
                                    <div class="modal_field_value" id="bank_branch_modal"></div>
                                </div>




                                <div class="col-md-12">
                                    <div class="modal_field_name">Bank Account No.:</div>
                                    <div class="modal_field_value" id="bank_account_number_modal"></div>
                                </div>

                                <div class="col-md-12">
                                    <div class="modal_field_name">IFSC Code:</div>
                                    <div class="modal_field_value" id="bank_ifsc_code_modal"></div>
                                </div>
                            </div>
                        </div>
                        <div class="section1">
                            <div class="row color1">
                                <div class="col-md-12">
                                    <h2>Additional Details</h2>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="modal_field_name">Application Phase:</div>
                                    <div class="modal_field_value" id=app_phase_modal></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal_field_name">Temple type:</div>
                                    <div class="modal_field_value" id=temple_type_modal></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section1">
                    <div class="row color1">
                        <div class="col-md-12">
                            <h2>Self Declaration</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal_field_name">I <span id="ssp_y_n_modal"></span> a beneficiary
                                of any other Social Security pension scheme or a recipient of Government
                                pension or pension from any other organization.
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="modal_field_name">I <span id="pucca_house_y_n_modal"></span> Pucca
                                dwelling
                                house.</div>
                        </div>
                        <div class="col-md-12">
                            <div class="modal_field_name">In the event of my death, I hereby nominate
                                (Please mention Name, Address &
                                Relationship)</div>
                        </div>
                        <div class="col-md-12">
                            <div class="modal_field_name">Name:</div>
                            <div class="modal_field_value" id="nominate_name_modal"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="modal_field_name">Address:</div>
                            <div class="modal_field_value" id="nominate_address_modal"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="modal_field_name">Relationship:</div>
                            <div class="modal_field_value" id="nominate_relationship_modal"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="modal_field_name">to receive the rest amount payable to me till my death
                            </div>

                        </div>
                        <div class="col-md-12 aadhar-text-modal">
                            <div class="modal_field_name">I <span id="av_status_modal">give</span> consent to
                                the
                                use of the Aadhaar No.for authenticating my identity for social security pension
                                (In
                                case Aadhaar no. provided by the applicant)</div>

                        </div>
                        <div class="col-md-12">
                            <div class="modal_field_name">Presently, I am reciving following pension(s) from:
                            </div>
                            <div class="modal_field_value" id="receive-pension-modal"></div>
                        </div>

                        <div class="col-md-12 self">
                            <div>In case the applicant is receiving pension from other sources:</div>
                            <ul>
                                <li>1.<span id="receiving_pension_other_source_1_txt"></span></li>
                                <li>2.<span id="receiving_pension_other_source_2_txt"></span></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer text-center" style="text-align: center;">

            <button type="reset" class="btn btn-danger btn-lg">Reset</button>
            <button type="button" id="submit-btn" class="btn btn-success btn-lg modal-submit" data-bs-dismiss="modal"
                aria-label="Close">Submit</button>
        </div>
    </div>
</div>


<script>
    // document.addEventListener('DOMContentLoaded', () => {
    //     const confirm_submit = document.getElementById('confirm_submit').value;
    //     if (confirm_submit === '1') {


    //         const formSelectElements = document.querySelectorAll("#confirm-submit .form-select");
    //         const formControlElements = document.querySelectorAll("#confirm-submit .form-control");

    //         // Add 'd-none' class to all selected elements
    //         formSelectElements.forEach((element) => {
    //             element.classList.add("d-none");
    //         });

    //         formControlElements.forEach((element) => {
    //             element.classList.add("d-none");
    //         });


    //     }
    //     // Select elements inside the modal
    //     const detailSections = document.querySelectorAll(
    //         '#confirm-submit #personal_details, ' +
    //         '#confirm-submit #id_details, ' +
    //         '#confirm-submit #contact_details, ' +
    //         '#confirm-submit #land_details, ' +
    //         '#confirm-submit #bank_details, ' +
    //         '#confirm-submit #additional_details, ' + // Added missing comma
    //         '#confirm-submit #decl_details'
    //     );

    //     const buttonsToFade = document.querySelectorAll(
    //         '#confirm-submit #btn_personal_details, ' +
    //         '#confirm-submit #previous_btn_id_details, ' +
    //         '#confirm-submit #btn_id_details, ' +
    //         '#confirm-submit #previous_btn_contact_details, ' +
    //         '#confirm-submit #btn_contact_details, ' +
    //         '#confirm-submit #previous_btn_land_details, ' +
    //         '#confirm-submit #btn_land_details, ' +
    //         '#confirm-submit #previous_btn_bank_details, ' +
    //         '#confirm-submit #btn_bank_details, ' +
    //         '#confirm-submit #previous_btn_decl_details, ' +
    //         '#confirm-submit #btn_submit_preview, ' + // Added missing comma
    //         '#confirm-submit #btn_add_details, ' + // Added missing comma
    //         '#confirm-submit #previous_btn_add_details'
    //     );

    //     // Remove 'fade' class and add 'active in' class to detail sections
    //     detailSections.forEach(section => {
    //         section.classList.remove('fade');
    //         section.classList.add('active', 'in');
    //     });

    //     // Add 'fade' class to buttons
    //     buttonsToFade.forEach(button => {
    //         button.classList.add('fade');
    //     });
    // });


    document.getElementById('btn_submit_preview').addEventListener('click', function () {
        document.getElementById('app_phase_modal').textContent = document.getElementById('app_phase').value;
        document.getElementById('name_modal').textContent = document.getElementById('first_name').value + ' ' +
            document.getElementById('middle_name').value + ' ' + document.getElementById('last_name').value;
        document.getElementById('gender_modal').textContent = document.getElementById('gender').value;
        document.getElementById('dob_modal').textContent = document.getElementById('dob').value;
        document.getElementById('father_name_modal').textContent = document.getElementById('father_first_name').value + ' ' +
            document.getElementById('father_middle_name').value + ' ' + document.getElementById('father_last_name').value;
        document.getElementById('mother_name_modal').textContent = document.getElementById('mother_first_name').value + ' ' +
            document.getElementById('mother_middle_name').value + ' ' + document.getElementById('mother_last_name').value;
        document.getElementById('marital_status_modal').textContent = document.getElementById('marital_status').value;

        var caste = document.getElementById('caste_category')
        if (caste) {
            document.getElementById('caste_category_modal').textContent = document.getElementById('caste_category').value;
        }
        else {
            document.getElementById('caste_category_modal').textContent = 'General'
        }
        var maritals = document.getElementById('marital_status').value;
        if (maritals == 'Married') {
            document.getElementById('spouse_name_modal').textContent = document.getElementById('spouse_first_name').value + ' ' +
                document.getElementById('spouse_middle_name').value + ' ' + document.getElementById('spouse_last_name').value;
        }


        document.getElementById('temple_type_modal').textContent = document.getElementById('temple_type').value;
        document.getElementById('ration_card_no_modal').textContent = document.getElementById('ration_card_cat').value + '-' +
            document.getElementById('ration_card_no').value;
        document.getElementById('aadhar_no_modal').textContent = document.getElementById('aadhar_no').value;
        document.getElementById('epic_voter_id_modal').textContent = document.getElementById('epic_voter_id').value;
        document.getElementById('pan_no_modal').textContent = document.getElementById('pan_no').value;
        document.getElementById('state_modal').textContent = document.getElementById('state').value;
        document.getElementById('asmb_cons_modal').textContent = document.querySelector('#asmb_cons option:checked').textContent;
        document.getElementById('district_modal').textContent = document.querySelector('#district option:checked').textContent;
        document.getElementById('police_station_modal').textContent = document.getElementById('police_station').value;
        document.getElementById('block_modal').textContent = document.querySelector('#block_urbanBody option:checked').textContent;
        document.getElementById('gp_ward_modal').textContent = document.querySelector('#gp_ward option:checked').textContent;
        document.getElementById('village_modal').textContent = document.getElementById('village').value;
        document.getElementById('house_modal').textContent = document.getElementById('house').value;
        document.getElementById('post_office_modal').textContent = document.getElementById('post_office').value;
        document.getElementById('pin_code_modal').textContent = document.getElementById('pin_code').value;
        document.getElementById('residency_period_modal').textContent = document.getElementById('residency_period').value;
        document.getElementById('mobile_no_modal').textContent = document.getElementById('mobile_no').value;
        document.getElementById('email_modal').textContent = document.getElementById('email').value;
        var isChecked = document.getElementById('cur_per_same').checked;
        if (isChecked) {
            document.getElementById('state_cur_modal').textContent = document.getElementById('state').value;
            document.getElementById('asmb_cons_cur_modal').textContent = document.querySelector('#asmb_cons option:checked').textContent;
            document.getElementById('district_cur_modal').textContent = document.querySelector('#district option:checked').textContent;
            document.getElementById('police_station_cur_modal').textContent = document.getElementById('police_station').value;
            document.getElementById('block_cur_modal').textContent = document.querySelector('#block_urbanBody option:checked').textContent;
            document.getElementById('gp_ward_cur_modal').textContent = document.querySelector('#gp_ward option:checked').textContent;
            document.getElementById('village_cur_modal').textContent = document.getElementById('village').value;
            document.getElementById('house_cur_modal').textContent = document.getElementById('house').value;
            document.getElementById('post_office_cur_modal').textContent = document.getElementById('post_office').value;
            document.getElementById('pin_code_cur_modal').textContent = document.getElementById('pin_code').value;
        } else {
            document.getElementById('state_cur_modal').textContent = document.getElementById('state_cur').value;
            document.getElementById('asmb_cons_cur_modal').textContent = document.querySelector('#asmb_cons_cur option:checked').textContent;
            document.getElementById('district_cur_modal').textContent = document.querySelector('#district_cur option:checked').textContent;
            document.getElementById('police_station_cur_modal').textContent = document.getElementById('police_station_cur').value;
            document.getElementById('block_cur_modal').textContent = document.querySelector('#block_cur option:checked').textContent;
            document.getElementById('gp_ward_cur_modal').textContent = document.querySelector('#gp_ward_cur option:checked').textContent;
            document.getElementById('village_cur_modal').textContent = document.getElementById('village_cur').value;
            document.getElementById('house_cur_modal').textContent = document.getElementById('house_cur').value;
            document.getElementById('post_office_cur_modal').textContent = document.getElementById('post_office_cur').value;
            document.getElementById('pin_code_cur_modal').textContent = document.getElementById('pin_code_cur').value;
        }

        document.getElementById('mouza_name_modal').textContent = document.getElementById('mouza_name').value;
        document.getElementById('land_jlno_modal').textContent = document.getElementById('land_jlno').value;
        document.getElementById('khatian_no_modal').textContent = document.getElementById('khatian_no').value;
        document.getElementById('plot_no_modal').textContent = document.getElementById('plot_no').value;
        document.getElementById('land_area_modal').textContent = document.getElementById('land_area').value;
        document.getElementById('land_holdername_modal').textContent = document.getElementById('land_holdername').value;

        document.getElementById('bank_account_number_modal').textContent = document.getElementById('bank_account_number').value;
        document.getElementById('name_of_bank_modal').textContent = document.getElementById('name_of_bank').value;
        document.getElementById('bank_branch_modal').textContent = document.getElementById('bank_branch').value;
        document.getElementById('bank_ifsc_code_modal').textContent = document.getElementById('bank_ifsc_code').value;

        document.getElementById('ssp_y_n_modal').textContent = document.querySelector('#ssp_y_n option:checked').textContent;
        document.getElementById('pucca_house_y_n_modal').textContent = document.querySelector('#pucca_house_y_n option:checked').textContent;
        document.getElementById('nominate_name_modal').textContent = document.getElementById('nominate_name').value;
        document.getElementById('nominate_address_modal').textContent = document.getElementById('nominate_address').value;
        document.getElementById('nominate_relationship_modal').textContent = document.getElementById('nominate_relationship').value;

        document.getElementById('av_status_modal').textContent = document.querySelector('#av_status option:checked').textContent;
        document.getElementById('text_1_modal').textContent = document.getElementById('text_1').value;
        document.getElementById('text_2_modal').textContent = document.getElementById('text_2').value;
        document.getElementById('receiving_pension_other_source_1_txt').textContent = document.getElementById('receiving_pension_other_source_1').value;
        document.getElementById('receiving_pension_other_source_2_txt').textContent = document.getElementById('receiving_pension_other_source_2').value;
    });


</script>