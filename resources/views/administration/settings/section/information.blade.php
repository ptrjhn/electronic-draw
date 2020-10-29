<section class="uis-margin-large">
    <p class="uis-text-medium
            uis-text-emphasis">
        Your Information
    </p>

    <hr class="uis-hr
            uis-margin">

    <div>
        <div class="uis-flex
                uis-flex-between
                uis-margin">
            <div>
                <p class="uis-margin-remove">
                    Full name
                </p>
                <p class="uis-margin-remove
                        uis-text-meta">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </p>
            </div>

            {{-- <div>
                <button class="uis-button
                        uis-button-text
                        uis-button-text-primary" uis-modal="#fullname-modal">
                    Edit
                </button>
            </div> --}}
        </div>

        <div class="uis-flex
                uis-flex-between
                uis-margin">
            <div>
                <p class="uis-margin-remove">
                    Username
                </p>
                <p class="uis-margin-remove
                        uis-text-meta">
                    {{ Auth::user()->username }}
                </p>
            </div>

            {{-- <div>
                <button class="uis-button
                        uis-button-text
                        uis-button-text-primary" uis-modal="#email-modal">
                    Edit
                </button>
            </div> --}}
        </div>
    </div>
</section>