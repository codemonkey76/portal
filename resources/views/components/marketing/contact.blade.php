<div class="mt-8 relative bg-white">
    <a id="contact_us" class="absolute -mt-20"></a>
    <div class="absolute inset-0">
        <div class="absolute inset-y-0 left-0 w-1/2 bg-gray-50"></div>
    </div>
    <div class="relative max-w-7xl mx-auto lg:grid lg:grid-cols-5">
        <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
            <div class="max-w-lg mx-auto">
                <h2 class="text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-3xl sm:leading-9">
                    Get in touch
                </h2>
                <p class="mt-3 text-lg leading-6 text-gray-500">
                    If you are interested in finding out more information or would like to sign up, please let us know
                    your requirements and one of our friendly team will contact you shortly.
                </p>
                <dl class="mt-8 text-base leading-6 text-gray-500">
                    <div>
                        <dt class="sr-only">Postal address</dt>
                        <dd>
                            <p>1/48 Lillian Ave</p>
                            <p>Salisbury, QLD 4107</p>
                        </dd>
                    </div>
                    <div class="mt-6">
                        <dt class="sr-only">Phone number</dt>
                        <dd class="flex">
                            <!-- Heroicon name: phone -->
                            <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="ml-3">
                                <a href="tel:0732773636">(07) 3277 3636</a>
                            </span>
                        </dd>
                    </div>
                    <div class="mt-3">
                        <dt class="sr-only">Email</dt>
                        <dd class="flex">
                            <!-- Heroicon name: mail -->
                            <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="ml-3">
                sales@asgcommunications.com.au
              </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="bg-white py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12">
            <div class="max-w-lg mx-auto lg:max-w-none">
                <form action="{{ route('website_contact.store') }}" method="POST" class="grid grid-cols-1 gap-y-6">
                    @csrf
                    <div class="space-y-4">
                        <x-input.group for="full_name" label="Full name">
                            <x-input.text name="full_name" />
                        </x-input.group>
                        <x-input.group for="email" label="Email">
                            <x-input.text type="email" name="email" />
                        </x-input.group>
                        <x-input.group for="phone" label="Phone">
                            <x-input.text name="phone" />
                        </x-input.group>
                    </div>

                    <div>
                        <p class="text-sm leading-5 text-gray-500">I am predominantly interested in.</p>
                        <div class="mt-4 ml-6">
                            <div class="flex items-center">
                                <input id="starter_plan" name="plan" type="radio"
                                       class="form-radio h-4 w-4 text-asg-500 transition duration-150 ease-in-out">
                                <label for="starter_plan" class="ml-3">
                                    <span class="block text-sm leading-5 font-medium text-gray-500">Starter Plan</span>
                                </label>
                            </div>
                            <div class="mt-4 flex items-center">
                                <input id="unlimited_plan" name="plan" type="radio"
                                       class="form-radio h-4 w-4 text-asg-500 transition duration-150 ease-in-out">
                                <label for="unlimited_plan" class="ml-3">
                                    <span class="block text-sm leading-5 font-medium text-gray-500">Unlimited Plan</span>
                                </label>
                            </div>
                            <div class="mt-4 flex items-center">
                                <input id="custom_plan" name="plan" type="radio"
                                       class="form-radio h-4 w-4 text-asg-500 transition duration-150 ease-in-out">
                                <label for="custom_plan" class="ml-3">
                                    <span
                                        class="block text-sm leading-5 font-medium text-gray-500">Custom Plan</span>
                                </label>
                            </div>
                        </div>
                    </div>


                        <x-input.group for="message" label="Message">
                            <x-input.textarea name="message" />
                        </x-input.group>

                    <div class="">
            <span class="inline-flex rounded-md shadow-sm">
              <button type="submit"
                      class="inline-flex justify-center py-3 px-6 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-asg-500 hover:bg-asg-400 focus:outline-none focus:border-asg-600 focus:shadow-outline-indigo active:bg-asg-600 transition duration-150 ease-in-out">
                Submit
              </button>
            </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>