@extends('layout.master')

@section('content')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #viewdoc {
            cursor: pointer;
            margin-bottom: 0px;
        }

        #viewdoc i {
            color: red;
            margin-right: 10px;
        }

        #downdoc i {
            color: green;

        }

        #downdoc {
            cursor: pointer;
            margin-bottom: 0px;
        }

        .document-all {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #pdf-icon i {
            color: red;
            font-size: 14px;
        }
    </style>

    <div id="loader" class="loader" style="display:none;"></div>

    <div id="fileContent"></div>

    <section class="log-sect dashboard-data">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="thm-section-title text-center">
                        <h2>Member's Documents</h2>
                    </div>
                    <div class="responsive-table-data" id="listdoc">
                        <table id="member-list">
                            <thead>
                                <tr class="my-table-header">
                                    <th style="text-align: center;">Title</th>
                                    <!--  <th style="text-align: center;">Doc Type</th> -->
                                    <th style="text-align: center;">File Size</th>
                                    <th style="text-align: center;">Create Date</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files_with_links as $file)
                                    <?php
                                    // Remove the file extension
                                    $fileNameWithoutExtension = pathinfo($file['FILENAME'], PATHINFO_FILENAME);
                                    $originalDate = $file['CREATED_DATE'];
                                    $formattedDate = (new DateTime($originalDate))->format('d F Y');
                                    ?>
                                    <tr class="table-data">
                                        <td style="text-align: left;" id="pdf-icon"><i class="fas fa-file-pdf"
                                                aria-hidden="true"></i>&nbsp {{ $file['FILENAME'] }}</td>
                                        <!--  <td style="text-align: center;" id="pdf-icon"></td> -->
                                        <td style="text-align: center;">{{ $file['SIZE'] }}</td>
                                        <td style="text-align: center;">{{ $formattedDate }}</td>
                                        <td class="document-all">
                                            <p id="viewdoc" data-id="{{ $file['FILENAME'] }}"><i class="fa fa-eye"
                                                    aria-hidden="true"></i>
                                            </p>
                                            <?php $file_download = '100211002103409.pdf'; ?>
                                            <p id="downdoc" data-id="{{ $file_download }}"><i class="fa fa-download"
                                                    aria-hidden="true"></i>
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="loader"></div>
    </section>
@endsection



@section('scripts')

    <script type="text/javascript">

        $(document).ready(function() {
            $('#member-list').DataTable({
                language: {
                    lengthMenu: "Show _MENU_ Entries per page",
                    zeroRecords: "No records available",
                    info: "Showing page _PAGE_ of _PAGES_",
                    infoEmpty: "No records available",
                    infoFiltered: "(filtered from _MAX_ total records)"
                }
            });

            $(document).on('click', '#viewdoc', function() {
                var dataId = $(this).attr('data-id');

                $.ajax({
                    url: '{{ route('file-details') }}',
                    method: 'POST',
                    data: {
                        _method: 'post',
                        _token: '{{ csrf_token() }}',
                        fileName: dataId,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            alert(response.msg);
                        } else {
                            var link = response.data[0].view_document_link;
                            window.open(link, "_blank");
                            console.log(link);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });

            $(document).on('click', '#downdoc', function() {
                var dataId = $(this).attr('data-id');

                $.ajax({
                    url: '{{ route('file-download') }}',
                    method: 'POST',
                    data: {
                        _method: 'post',
                        _token: '{{ csrf_token() }}',
                        fileName: dataId,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            alert(response.msg);
                        } else {
                            var link = response.data[0].Download_file_url;
                            var tempLink = document.createElement('a');
                            tempLink.href = link;
                            tempLink.setAttribute('download', '');
                            tempLink.style.display = 'none';
                            document.body.appendChild(tempLink);
                            tempLink.click();
                            document.body.removeChild(tempLink);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });
        });
    </script>

@endsection
