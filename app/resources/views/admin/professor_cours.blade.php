@extends("layouts.navbar")

@section('content')

    <script>
        $(function () {
            const cours = <?php echo $cours ?>;
            $('#cours').autocomplete({
                source: cours
            });
        });

        $(function () {
            const enseignants = <?php echo $enseignants ?>;

            function split(val) {
                return val.split(/,\s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }

            $('#enseignant').on("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            }).autocomplete({
                minLength: 0,
                source: function (request, response) {
                    response($.ui.autocomplete.filter(
                        enseignants, extractLast(request.term)));
                },
                focus: function () {
                    return false;
                },
                select: function (event, ui) {
                    var terms = split(this.value);
                    terms.pop();
                    terms.push(ui.item.value);
                    terms.push("");
                    this.value = terms.join(", ");
                    return false;
                }
            });
        });
    </script>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Assigner des enseignants à un cours</h3>
                        <div class="card-body">
                            <form action="{{route('professor.cours.process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="cours">Nom ou code du cours</label>
                                    <input type="text" class="form-control autocomplete" id="cours" name="cours"
                                           required autofocus>
                                </div>
                                <div class="form-group mb-3 ui-widget">
                                    <label for="enseignant">Enseignants</label>
                                    <textarea class="form-control autocomplete" id="enseignant"
                                              name="enseignant"></textarea>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Assigner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
