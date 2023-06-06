@extends('Light.layouts.app')

@section('content')
    <div class="container py-4 text-white" id="contact">
        <strong class="fs-1 mb-5 d-block">Contact</strong>
        <!-- Bootstrap 5 starter form -->
        <form id="contactForm" class="col-lg-6 col-sm-12" data-aos="fade-down" action="{{ route('contact.us.store') }}"
              method="post">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            @csrf
            <!-- Name input -->
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" id="name" type="text" placeholder="Name" name="name" required/>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <!-- Email address input -->
            <div class="mb-3">
                <label class="form-label" for="emailAddress">Email Address</label>
                <input class="form-control" id="emailAddress" type="email" placeholder="Email Address" name="email"
                       required/>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <!-- Message input -->
            <div class="mb-3">
                <label class="form-label" for="message">Message</label>
                <textarea class="form-control" name="message" id="message" type="text" placeholder="Message"
                          style="height: 10rem;" required></textarea>
                @if ($errors->has('message'))
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                @endif
            </div>

            <!-- Form submit button -->
            <div>
                <button class="btn btn-info btn-lg contact_submit" type="submit" disabled>Submit</button>
            </div>

        </form>
    </div>
@endsection
