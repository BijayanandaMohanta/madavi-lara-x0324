<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Report</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #F3F3F3;
        }

        table,
        th,
        td {
            border-collapse: collapse;
        }

        table {
            width: 100%;
        }

        tr:has(th) {
            background-color: orange;

            & th {
                padding: .4rem;
                border: 1px solid orange;
            }
        }

        th {
            text-align: left;
        }

        th:first-child {
            width: 20rem;
        }

        td {
            padding: .3rem;
        }

        h3 {
            text-align: center;
        }

        .report {
            margin: 2rem 12%;
            padding: 2rem;
            border: 1px solid #cbcbcb;
            border-radius: 4px;
            background: #fff;
        }

        .report-header {
            border: 1px solid #4b4b4b;
        }

        .group {
            padding-top: 2rem;
        }

        .sub_group {
            border: 1px solid #4b4b4b;
            margin-bottom: 1rem;

            & h3 {
                text-transform: uppercase;
            }
        }

        .solid_border {
            border: 1px solid #000;
            margin-inline: 10px;
            margin-block-end: 10px;
            width: 98%;
            font-size: .8rem;

            & td {
                border: 1px solid #000;
            }
        }

        .comments {
            margin-top: 3rem;
        }

        .report-footer {
            display: flex;
            justify-content: space-between;

            & div:last-child {
                text-align: right;
            }
        }

        input[type="text"] {
            outline: none;
            padding: .4rem;
            border-radius: .2rem;
            border: 1px solid #cbcbcb;
        }
    </style>
    <style>
        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            /* Space between buttons */
            z-index: 1000;
            /* Ensure buttons are above other content */
        }

        .floating-button {
            padding: 10px 15px;
            background-color: #242424;
            /* Blue background */
            color: white;
            /* White text */
            border: none;
            border-radius: 5px;
            /* Rounded corners */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .floating-button:hover {
            background-color: #2c2c2c;
            /* Darker blue on hover */
        }
        .group-description{
            padding: 0 .4rem;
        }

        .group-description :not(h5) {
            font-size: .8rem;
        }

        .group-description table {
            border: 1px solid #000;
            margin-inline: 10px;
            margin-block-end: 10px;
            width: 98% !important;
        }

        .group-description table td {
            border: 1px solid #000;
            padding: 2px;
        }

        .group-description table tr {
            background-color: unset !important;
        }

        .group-description table th {
            padding: .4rem;
            border: unset !important;
        }


        /* Print CSS */
        @media print {
            .floating-buttons {
                display: none;
                /* Hide buttons when printing */
            }

            .report {
                margin: 2rem 5%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>

<body>
    <form action="{{ route('report_save') }}" method="POST">
        @csrf
        <input type="hidden" name="sid" value="{{ $sid }}">

        @php
            $record = \App\Report::where('sid', $sid)->first();
            if ($record) {
                $form_values = $record->form_values;
                $form_values = json_decode($form_values);
            } else {
                $form_values = null;
            }
            // dd(count($form_values));
            $count = 0;
        @endphp

        <div class="report" id="content">
            <table class="report-header">
                <tr>
                    <td>Patient Name :</td>
                    <td>Mr. Srikanta Neerudi</td>
                    <td>Registered on :</td>
                    <td>2019-01-01</td>
                    <td>04:37 PM</td>
                    <td rowspan="5">
                        <figure>
                            <img src="https://placehold.co/100x50" alt="Sample Image">
                            <figcaption>1002</figcaption>
                        </figure>
                    </td>
                </tr>
                <tr>
                    <td>Age/Sex :</td>
                    <td>26 Yrs/M</td>
                    <td>Collected on :</td>
                    <td>2019-01-01</td>
                    <td>04:37 PM</td>
                </tr>
                <tr>
                    <td>Referred By :</td>
                    <td>Dr Vasanth Kumar(md)</td>
                    <td>Received on :</td>
                    <td>2019-01-01</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Reg. no. / UHID :</td>
                    <td>1002 /</td>
                    <td>Reported on :</td>
                    <td>2019-01-01</td>
                    <td>04:38 PM</td>
                </tr>
                <tr>
                    <td>Petient</td>
                    <td colspan="4">Brahampuri Colony Mallapur, Hyderabad</td>
                </tr>
            </table>
            <div class="group">
                @forelse ($allValues as $item)
                    @php
                        // $testIds = explode(',', $test->tests);
                        $testinfo = \App\Test::where('id', $item)->get();
                    @endphp

                    @foreach ($testinfo as $test)
                        <div class="sub_group">
                            <h3>{{ $test->name }}</h3>
                            <table>
                                <tr>
                                    <th><b>TEST</b></th>
                                    <th>VALUE</th>
                                    <th>UNIT</th>
                                    <th>REFERENCE</th>
                                </tr>
                                @php
                                    if ($test->test_groups) {
                                        $test_groups = explode(',', $test->test_groups);
                                    } else {
                                        $test_groups = '';
                                    }
                                @endphp
                                @if ($test_groups)
                                    @foreach ($test_groups as $result)
                                        @php
                                            // print_r($result);
                                            // die;
                                            $test_group = \App\TestGroup::where('id', $result)->first();
                                            $unit_res = \App\Unit::where('id', $test_group->unit)->first();
                                        @endphp
                                        <tr>
                                            <td>{!! $test_group->group_name !!}</td>
                                            <td>
                                                @if (!empty($unit_res->unit))
                                                    <input type="text" name="values[]"
                                                        value="{{ isset($form_values) && isset($form_values[$count]) ? $form_values[$count++] : '' }}">
                                                @endif
                                            </td>
                                            <td>{{ $unit_res ? $unit_res->unit : '' }}</td>
                                            <td>{!! $test_group->reference_desc ?? '' !!}</td>
                                        </tr>
                                        @if (!$test_group->unit)
                                            @php

                                                $test_sub_groups = \App\TestSubGroup::where(
                                                    'test_group_id',
                                                    $test_group->id
                                                )->get();
                                                // dd($test_group->id);
                                            @endphp
                                            {{-- @if ($test_sub_groups) --}}
                                            @foreach ($test_sub_groups as $sub_group)
                                                @php
                                                    $unit_res = \App\Unit::where('id', $sub_group->unit)->first();
                                                @endphp
                                                <tr>
                                                    <td>{!! $sub_group->sub_group_name !!}</td>
                                                    <td>
                                                        <input type="text" name="values[]"
                                                            value="{{ isset($form_values) && isset($form_values[$count]) ? $form_values[$count++] : '' }}">
                                                    </td>
                                                    <td>{{ $unit_res->unit ?? '' }}</td>
                                                    <td>{!! $sub_group->reference_desc ?? '' !!}</td>
                                                </tr>
                                            @endforeach
                                            {{-- @endif --}}
                                        @endif
                                    @endforeach
                                @else
                                    {{ 'No test groups assigned to test' }}
                                @endif
                            </table>
                            <div class="group-description">
                                @php
                                    $interpretation = \App\Interpretation::where('test_id', $test->id)->first();
                                    // dd($interpretation);
                                @endphp

                                @if (!empty($interpretation) && !empty($interpretation->description))
                                    <h5>Interpretation</h5>
                                    {!! $interpretation->description !!}
                                @else
                                    {{-- Code to display a message or handle the case when no interpretation description is found --}}
                                @endif
                            </div>
                        </div>
                    @endforeach
                @empty
                    <p>No test added!</p>
                @endforelse

                <div class="sub_group" style="display: none;">
                    <h3>LIPID PROFILE</h3>
                    <table>
                        <tr>
                            <th><b>TEST</b></th>
                            <th>VALUE</th>
                            <th>UNIT</th>
                            <th>REFERENCE</th>
                        </tr>
                        <tr>
                            <td>Total Cholesterol </td>
                            <td></td>
                            <td>mg/dl</td>
                            <td>125 - 200</td>
                        </tr>
                        <tr>
                            <td>Triglycerides</td>
                            <td></td>
                            <td>mg/dl</td>
                            <td>25 - 200</td>
                        </tr>
                        <tr>
                            <td>HDL Cholesterol</td>
                            <td></td>
                            <td>mg/dl</td>
                            <td>35 - 80</td>
                        </tr>
                        <tr>
                            <td>LDL Cholesterol</td>
                            <td></td>
                            <td>mg/dl</td>
                            <td>85 - 130</td>
                        </tr>
                    </table>
                </div>
                <div class="sub_group" style="display: none;">
                    <h3>LIVER FUNCTION TEST(LFT)</h3>
                    <table>
                        <tr>
                            <th><b>TEST</b></th>
                            <th>VALUE</th>
                            <th>UNIT</th>
                            <th>REFERENCE</th>
                        </tr>
                        <tr>
                            <td><b>Serum Bilirubin(Total)</b></td>
                            <td>L 0.1</td>
                            <td>mg/dl</td>
                            <td>0.2-1.2</td>
                        </tr>
                        <tr>
                            <td><b>Serum Bilirubin(Direct)</b></td>
                            <td>H 2.0</td>
                            <td>mg/dl</td>
                            <td>0-0.3</td>
                        </tr>
                        <tr>
                            <td><b>Serum Bilirubin(Indirect)</b></td>
                            <td>L -1.90</td>
                            <td>mg/dl</td>
                            <td>0.2-1</td>
                        </tr>
                        <tr>
                            <td>SGOT (AST)</td>
                            <td>25</td>
                            <td>U/I</td>
                            <td>0-37</td>
                        </tr>
                    </table>
                    <h5>Interpreatation</h5>
                    <table class="solid_border">
                        <tr>
                            <td>Total Cholesterol</td>
                            <td>(mg/dl)</td>
                            <td>HDL</td>
                            <td>(mg/dl)</td>
                            <td>LDL</td>
                            <td>(mg/dl)</td>
                            <td>Triglycerides</td>
                            <td>(mg/dl)</td>
                        </tr>
                        <tr>
                            <td>Desirable</td>
                            <td>
                                <200< /td>
                            <td>Low</td>
                            <td>
                                <40< /td>
                            <td>Optimal</td>
                            <td>
                                <100< /td>
                            <td>Normal</td>
                            <td>
                                <150< /td>
                        </tr>
                        <tr>
                            <td>Borderline High</td>
                            <td>200-239</td>
                            <td>High</td>
                            <td> >60</td>
                            <td>Near Optimal</td>
                            <td>100-129</td>
                            <td>Borderline High</td>
                            <td>150-199</td>
                        </tr>
                        <tr>
                            <td>High</td>
                            <td> >240</td>
                            <td></td>
                            <td></td>
                            <td>Borderline High</td>
                            <td>130-159</td>
                            <td>High</td>
                            <td>200-499</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="group-description" style="display: none;">
                <p>
                <h4>Physiological basis</h4>
                Plasma iron concentration is determined by absorption from the intestine; storage in the intestine,
                liver,
                spleen,
                bone marrow, rate of breakdown or loss of hemoglobin, and rate of synthesis of new hemoglobin.
                </p>
                <h4>Interpreatation for iron (fe), serum or plasma</h4>
                <table class="solid_border">
                    <tr>
                        <td>Increased</td>
                        <td>Decreased</td>
                    </tr>
                    <tr>
                        <td>
                            Hemosiderosis (eg, multiple transfusions, excess iron administration), acute Fe poisoning
                            (children),
                            hemolytic anemia, pernicious anemia, aplastic or hypoplastic anemia, viral hepatitis, lead
                            poisoning,
                            thalassemia, hemochromatosis. Drugs: estrogens, ethanol, oral contraceptives.
                        </td>
                        <td>
                            Iron deficiency, nephrotic syndrome, chronic renal failure, many infections, active
                            hematopoiesis, remission
                            of pernicious anemia, hypothyroidism, malignancy (carcinoma), postoperative state,
                            kwashiorkor.
                        </td>
                    </tr>
                </table>
                <div class="comments">
                    Comments : <br>
                    Method : <br>
                    *** <br>
                    <p>
                        The Biological Reference Ranges is specific to the age group. Kindly correlate clinically.
                        T3,T4 - Fully Automated Electrochemiluminescence Compititive Immunoassay
                        USTSH - Fully Automated Electrochemiluminescence Sandwich Immunoassay
                        Disclaimer :Results should always be interpreted using the reference range provided by the
                        laboratory that
                        performed the test. Different laboratories do tests using different technologies, methods and
                        using
                        different
                        reagents which may cause difference. In reference ranges and hence it is recommended to
                        interpret
                        result with
                        assay specific reference ranges provided in the reports. To diagnose and monitor therapy doses,
                        it
                        is
                        recommended
                    </p>
                </div>
            </div>
            <p align="center">~~~ End of report ~~~</p>
            <div class="report-footer">
                <div class="rf_col">
                    Mr. Sachin Sharma <br>
                    DMLT, Lab Incharge
                </div>
                <div class="rf_col">
                    Dr. A. K. Asthana <br>
                    MBBS, MD Pathologist
                </div>
            </div>
        </div>

        <!-- Sticky Floating Buttons -->
        <div class="floating-buttons">
            <button id="backButton" class="floating-button"><i class="bi bi-arrow-left"></i> Back</button>
            <button id="printButton" class="floating-button"><i class="bi bi-printer"></i> Print</button>
            <button type="submit" id="save" class="floating-button"><i class="bi bi-floppy"></i> Save</button>
            {{-- <button id="downloadPdfButton" class="floating-button"><i class="bi bi-filetype-pdf"></i> Download PDF</button> --}}
        </div>
    </form>
    <script>
        const tables = document.querySelectorAll('.group-description .table');
        tables.forEach(table => {
            table.classList.add("solid_border");
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Print button functionality
            document.getElementById('printButton').addEventListener('click', function() {
                window.print(); // Open the print dialog
            });

            // Back button functionality
            document.getElementById('backButton').addEventListener('click', function() {
                window.history.back(); // Go back in history
            });

            // Download PDF button functionality
            document.getElementById('downloadPdfButton').addEventListener('click', function() {
                const element = document.getElementById(
                    'content'); // Get the content to be converted to PDF
                element.classList.add('reset-styles');
                const opt = {
                    margin: 10, // Set margin to 10 mm (1 cm)
                    filename: 'download.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2, // Adjust this value to change the scaling of the content
                        useCORS: true // Enable CORS for images if necessary
                    },
                    jsPDF: {
                        unit: 'mm', // Use millimeters for the unit
                        format: 'a4', // Use A4 format
                        orientation: 'portrait',
                        user_unit: 'mm', // Set the user unit to millimeters
                        user_zoom: 0.68 // Set the zoom scale to 68%
                    }
                };

                // Hide the floating buttons
                const floatingButtons = document.querySelector('.floating-buttons');
                floatingButtons.style.display = 'none';

                // Generate the PDF
                html2pdf().from(element).set(opt).save().then(() => {
                    // Show the floating buttons back after saving the PDF
                    floatingButtons.style.display = 'flex';
                });
            });
        });
    </script>
</body>

</html>
