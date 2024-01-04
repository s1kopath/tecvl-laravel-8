@extends('../site/layouts.user_panel.app')
@section('page_title', __('Order Refund'))
@section('content')
    <div class="dark:bg-red-1 h-full xl:px-74p px-5 pt-30p xl:pt-14">
        <div class="flex justify-between">
            <div>
                <div class="flex items-center">
                    <span class="mr-4 hidden lg:block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="53" height="44" viewBox="0 0 53 44" fill="none">
                            <rect x="36.1779" y="27.377" width="16.6222" height="16.6222" rx="2" fill="#FCCA19" />
                            <rect width="32.2667" height="32.2667" rx="2" fill="#FCCA19" />
                        </svg>
                    </span>
                    <span class="mr-4 mt-1 lg:hidden block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="39" height="32" viewBox="0 0 39 32" fill="none">
                            <rect x="26.3115" y="19.9111" width="12.0891" height="12.0891" rx="2" fill="#FCCA19" />
                            <rect width="23.4671" height="23.4671" rx="2" fill="#FCCA19" />
                        </svg>
                    </span>
                    <h1 class="dm-sans font-medium lg:pt-0 text-2xl lg:text-4xl text-gray-12 mb-1 dark:text-gray-2">
                        {{ __('Your Refund') }}
                    </h1>
                </div>
                <p class="dark:text-gray-2 lg:mt-1.5 roboto-medium font-medium text-base lg:text-xl mt-2 text-20 text-gray-10 leading-6"> {{ __('Customer satisfaction is our top priority..') }}</p>
            </div>
            <div class="xl:block hidden ">
                <p class="text-gray-12 mb-15p text-sm dm-sans font-medium">Want a Refund? Click the button below</p>
                <a href="{{ url('/user/create-refund-request') }}" >
                    <span  class="bg-yellow-1 py-3.5 px-9 w-190 h-12 rounded dm-sans text-sm ml-68p  ">{{ __('Request A Refund') }}</span>
                </a>
            </div>
        </div>
        <div class="xl:w-1/2 lg:w-3/5 2xl:w-1/3 w-full bg-gray-11 lg:mt-20 mt-10 flex justify-between rounded-lg">
            <div class="flex lg:ml-6 ml-4">
                <svg class="mt-7 mr-2.5 lg:block hidden" xmlns="http://www.w3.org/2000/svg" width="58" height="62" viewBox="0 0 58 62" fill="none">
                    <rect x="23.3574" y="17.6748" width="10.7315" height="10.7315" rx="2" fill="#FCCA19" />
                    <rect width="20.8318" height="20.8318" rx="2" fill="#FCCA19" />
                    <path d="M31.2656 4.16992C25.6242 4.94023 20.6398 8.02148 17.5359 12.666C16.777 13.7988 15.8594 15.5547 15.8594 15.8719C15.8594 16.2797 16.2898 16.6875 16.709 16.6875C17.1621 16.6875 17.2187 16.6195 18.057 15.0789C18.9293 13.493 19.8469 12.2695 21.1383 10.9781C24.3441 7.76094 28.5355 5.92578 33.0781 5.7332C36.8844 5.57461 40.532 6.59414 43.602 8.66719C44.191 9.05234 44.8027 9.47148 44.9613 9.57344C45.3691 9.85664 45.7316 9.82266 46.0488 9.49414C46.3773 9.17695 46.4113 8.80312 46.1621 8.45195C45.9129 8.10078 43.7719 6.68476 42.6051 6.10703C39.1047 4.35117 35.0266 3.66016 31.2656 4.16992Z"  fill="black" />
                    <path d="M31.3231 8.70093C27.97 9.31264 25.2286 10.7853 22.9403 13.1869C20.3802 15.8603 18.9755 19.0548 18.7376 22.7591C18.5677 25.3986 19.3153 28.6384 20.6407 30.9041C21.2184 31.9123 21.2977 32.456 20.9352 32.9998C20.5501 33.5662 19.9384 33.7587 19.2927 33.5095C18.9075 33.3623 18.7262 33.1923 18.4091 32.6599C17.0837 30.4736 16.1887 27.5962 15.9848 24.8888C15.8829 23.5408 15.9848 21.4337 16.2114 20.2896C16.336 19.6779 16.3247 19.5873 16.1208 19.3154C15.8149 18.9076 15.1805 18.8396 14.8634 19.1794C14.4216 19.6552 14.127 22.6572 14.2856 24.9341C14.4669 27.5849 15.0673 29.7712 16.3134 32.2634C17.2423 34.1439 17.5821 34.5857 18.4091 34.9935C20.1196 35.8205 22.204 34.9255 22.7251 33.1357C23.0196 32.1275 22.9063 31.6064 21.9887 29.7939C20.9919 27.8115 20.5501 26.2255 20.4368 24.1978C20.0856 17.5709 24.9001 11.5896 31.527 10.4001C33.1016 10.1169 35.5372 10.2076 37.0438 10.6041C41.9489 11.8955 45.6985 15.7584 46.7973 20.6521C46.9106 21.1845 47.0466 22.2267 47.0805 22.9744C47.4204 29.6127 42.6852 35.5373 36.1489 36.6814C34.7782 36.9306 34.6649 36.9193 34.6649 36.5341C34.6649 35.1634 33.5094 34.3591 32.5579 35.0615C31.2098 36.0584 27.6415 39.1849 27.5282 39.4681C27.3469 39.9099 27.4602 40.5556 27.7774 40.9068C28.3325 41.5072 32.7505 45.1209 33.0223 45.1888C33.9059 45.4154 34.6649 44.6224 34.6649 43.4669V43.1044L35.4919 43.0252C44.1352 42.1982 51.17 35.9224 52.9032 27.483C54.0473 21.9548 52.6087 15.815 49.1762 11.499C48.7684 10.9892 48.6551 10.9099 48.3153 10.9099C47.8169 10.9099 47.4657 11.2384 47.4657 11.7142C47.4657 11.9521 47.6243 12.2693 47.9641 12.6998C50.5583 16.0869 51.9063 20.6748 51.5438 24.9228C51.2606 28.2306 50.2751 31.04 48.4512 33.7361C47.477 35.1748 45.2227 37.3951 43.7727 38.358C41.1446 40.1025 38.12 41.1334 35.0614 41.3373C33.4981 41.4392 32.9657 41.7564 32.9657 42.5947C32.9657 42.7986 32.9317 42.9685 32.8864 42.9685C32.7844 42.9685 29.4087 40.1591 29.3634 40.0345C29.3294 39.9439 32.5239 37.2252 32.7958 37.1232C32.9204 37.0666 32.9657 37.1345 32.9657 37.3498C32.9657 37.7916 33.2376 38.256 33.5887 38.4146C34.2684 38.7318 36.602 38.4599 38.4598 37.8482C40.6801 37.1232 42.6059 35.9337 44.3618 34.1892C46.5594 32.0029 47.9528 29.3861 48.5645 26.3162C48.8024 25.1154 48.8251 22.2041 48.6098 20.9919C47.4884 14.6935 42.5153 9.76577 36.2622 8.71226C34.9821 8.49702 32.4559 8.48569 31.3231 8.70093Z" fill="black" />
                    <path d="M32.4438 14.0821C27.5614 14.7731 23.9591 19.1458 24.2763 23.9942C24.4349 26.2712 25.2278 28.129 26.7798 29.7942C28.0712 31.1876 29.3513 31.9805 31.0958 32.4903C36.2048 33.963 41.4384 30.927 42.8317 25.6934C43.1602 24.4473 43.1602 22.4309 42.8317 21.1622C42.5825 20.1879 41.7442 18.3754 41.3477 17.9676C40.9966 17.5825 40.5888 17.5258 40.2376 17.7864C39.7731 18.1376 39.7845 18.602 40.2716 19.3837C41.1552 20.8223 41.5743 22.7594 41.3477 24.4133C41.0985 26.2032 40.4188 27.5852 39.1388 28.8653C36.7259 31.2782 33.3388 31.8333 30.2462 30.3153C29.3739 29.8848 29.0114 29.6243 28.2524 28.8766C25.8282 26.4524 25.2845 23.0993 26.8138 19.9727C28.0032 17.5258 30.3708 15.9626 33.2255 15.7247C34.2337 15.634 35.6044 15.8719 36.6013 16.2911C37.6321 16.7329 38.0852 16.7782 38.3911 16.4497C38.7083 16.0985 38.697 15.6114 38.3571 15.2942C37.4395 14.4559 34.3243 13.8102 32.4438 14.0821Z" fill="black" />
                    <path d="M33.1466 17.1746C32.8973 17.4238 32.852 17.5711 32.852 18.1375C32.852 18.7832 32.8294 18.8172 32.5122 18.9531C32.0477 19.1457 31.3907 19.8141 31.1415 20.3578C30.8696 20.9695 30.8583 22.0344 31.1415 22.6348C31.5266 23.507 32.6821 24.2773 33.5657 24.2773C34.2454 24.2773 34.7778 24.7984 34.7778 25.4555C34.7778 25.6027 34.6419 25.8859 34.4833 26.0785C34.2454 26.373 34.1094 26.4297 33.7016 26.4297C33.1126 26.4297 32.6255 26.0105 32.6255 25.5008C32.6255 25.1156 32.0817 24.5039 31.7419 24.5039C31.6173 24.5039 31.3794 24.6172 31.2094 24.7531C30.9262 24.9797 30.9036 25.0477 30.9489 25.648C31.0169 26.543 31.4813 27.2793 32.2516 27.7324L32.8407 28.0723L32.852 28.7293C32.852 29.273 32.8973 29.4316 33.1352 29.6582C33.2825 29.8168 33.543 29.9414 33.7016 29.9414C33.8602 29.9414 34.1208 29.8168 34.268 29.6582C34.5059 29.4316 34.5512 29.273 34.5512 28.718C34.5512 28.0836 34.5739 28.0383 34.8798 27.9023C35.8426 27.5059 36.5563 26.2371 36.443 25.127C36.2958 23.7109 35.3669 22.8047 33.8602 22.5895C33.3051 22.5215 33.0899 22.4309 32.886 22.193C32.2856 21.4906 32.7614 20.4258 33.679 20.4258C34.2454 20.4258 34.7778 20.9129 34.7778 21.4453C34.7778 21.8758 35.2196 22.3516 35.6274 22.3516C36.0352 22.3516 36.477 21.8758 36.477 21.434C36.477 20.5277 35.6841 19.2816 34.9024 18.9645C34.5966 18.8285 34.5739 18.7719 34.5286 18.0922C34.4833 17.2879 34.336 17.0727 33.7923 16.9594C33.4977 16.9027 33.3731 16.948 33.1466 17.1746Z" fill="black" />
                    <path d="M5.31337 44.0221C4.72431 44.4186 4.62236 44.8717 4.66767 47.0241C4.70165 48.8139 4.71298 48.8819 4.97353 49.0971C5.31337 49.3803 5.83447 49.369 6.11767 49.0858C6.32157 48.8819 6.34423 48.7119 6.34423 47.16V45.4608L11.9856 45.4834L17.6157 45.5174V52.8807V60.244L11.9856 60.278L6.34423 60.3006V56.4151V52.5182L6.08368 52.2803C5.59657 51.8272 4.87157 52.0651 4.70165 52.7334C4.66767 52.8807 4.64501 54.8065 4.66767 57.0155C4.70165 61.003 4.70165 61.0369 4.9622 61.3994C5.12079 61.626 5.39267 61.8186 5.64189 61.8866C5.92509 61.9772 8.00946 61.9998 12.0763 61.9772L18.0915 61.9432L18.5106 61.6147C19.1224 61.1502 19.3716 60.5498 19.3716 59.485V58.6014L33.0559 58.5787C48.2696 58.5334 47.1821 58.6014 48.145 57.7291C49.0739 56.9022 49.4138 55.6448 49.0399 54.4213C48.8473 53.7983 48.0657 52.9147 47.3747 52.5748C46.8536 52.3256 46.7516 52.3143 43.07 52.2803C39.5696 52.2463 39.2977 52.2237 39.3657 52.0537C39.5243 51.6799 39.5583 50.6604 39.4337 50.1846C39.2071 49.403 38.6181 48.7006 37.8817 48.3381C37.2247 48.0209 37.2134 48.0209 34.336 47.953L31.436 47.885L29.2837 47.058C28.1056 46.6049 26.7462 46.1631 26.2817 46.0725C25.7153 45.9705 24.4352 45.9252 22.4075 45.9139H19.3716V45.6307C19.3716 44.9623 18.7712 44.1354 18.0915 43.8862C17.8763 43.8069 15.7239 43.7616 11.7364 43.7616H5.69853L5.31337 44.0221ZM26.0778 47.7717C26.5309 47.8623 27.5618 48.1909 28.3548 48.508C31.1528 49.6182 30.8809 49.5616 34.0415 49.6409C37.0321 49.7201 37.1681 49.7428 37.5985 50.2866C37.9837 50.7737 37.9157 51.408 37.4513 51.8725L37.0661 52.2576H34.2341C31.4134 52.2576 31.3907 52.2576 31.0849 52.5182C30.6884 52.8694 30.6544 53.4471 31.0282 53.753C31.2774 53.9455 31.6739 53.9569 38.754 53.9569C44.8485 53.9569 46.2985 53.9909 46.6044 54.1155C47.8391 54.6252 47.7485 56.4264 46.4684 56.7889C46.1966 56.8569 41.4614 56.9022 32.7161 56.9022H19.3716V52.2576V47.6131H22.3056C24.3899 47.6131 25.4774 47.6584 26.0778 47.7717Z"  fill="black" />
                </svg>
                <svg class="lg:mt-7 mt-5 mr-2.5 lg:hidden block" xmlns="http://www.w3.org/2000/svg" width="42" height="45"
                    viewBox="0 0 42 45" fill="none">
                    <rect x="16.9141" y="12.7988" width="7.77111" height="7.77111" rx="2" fill="#FCCA19" />
                    <rect width="15.0851" height="15.0851" rx="2" fill="#FCCA19" />
                    <g clip-path="url(#clip0_5647_3180)">
                        <path d="M22.6406 3.01953C18.5555 3.57734 14.9461 5.80859 12.6984 9.17187C12.1488 9.99219 11.4844 11.2637 11.4844 11.4934C11.4844 11.7887 11.7961 12.084 12.0996 12.084C12.4277 12.084 12.4687 12.0348 13.0758 10.9191C13.7074 9.7707 14.3719 8.88477 15.307 7.94961C17.6285 5.61992 20.6637 4.29102 23.9531 4.15156C26.7094 4.03672 29.3508 4.775 31.5738 6.27617C32.0004 6.55508 32.4434 6.85859 32.5582 6.93242C32.8535 7.1375 33.116 7.11289 33.3457 6.875C33.5836 6.64531 33.6082 6.37461 33.4277 6.12031C33.2473 5.86602 31.6969 4.84062 30.852 4.42227C28.3172 3.15078 25.3641 2.65039 22.6406 3.01953Z" fill="black" />
                        <path d="M22.6819 6.30067C20.2538 6.74364 18.2687 7.81005 16.6116 9.54911C14.7577 11.485 13.7405 13.7983 13.5683 16.4808C13.4452 18.3921 13.9866 20.7382 14.9464 22.3788C15.3648 23.1089 15.4222 23.5026 15.1597 23.8964C14.8808 24.3065 14.4378 24.446 13.9702 24.2655C13.6913 24.1589 13.5601 24.0358 13.3304 23.6503C12.3706 22.0671 11.7226 19.9835 11.5749 18.0229C11.5011 17.0468 11.5749 15.521 11.739 14.6925C11.8292 14.2495 11.821 14.1839 11.6733 13.987C11.4519 13.6917 10.9925 13.6425 10.7628 13.8886C10.4429 14.2331 10.2296 16.4069 10.3444 18.0558C10.4757 19.9753 10.9105 21.5585 11.8128 23.3632C12.4855 24.7249 12.7316 25.0448 13.3304 25.3401C14.5691 25.939 16.0784 25.2909 16.4558 23.9948C16.6691 23.2647 16.587 22.8874 15.9226 21.5749C15.2007 20.1393 14.8808 18.9909 14.7987 17.5225C14.5444 12.7237 18.0308 8.39247 22.8296 7.53114C23.9698 7.32606 25.7335 7.39169 26.8245 7.6788C30.3765 8.61395 33.0917 11.4112 33.8874 14.955C33.9694 15.3405 34.0679 16.0952 34.0925 16.6366C34.3386 21.4436 30.9097 25.7339 26.1765 26.5624C25.1839 26.7429 25.1019 26.7347 25.1019 26.4558C25.1019 25.4632 24.2651 24.8808 23.5761 25.3893C22.5999 26.1112 20.0159 28.3753 19.9339 28.5804C19.8026 28.9003 19.8847 29.3679 20.1144 29.6222C20.5163 30.0569 23.7155 32.6737 23.9124 32.7229C24.5523 32.887 25.1019 32.3128 25.1019 31.4761V31.2136L25.7007 31.1561C31.9597 30.5573 37.0538 26.0128 38.3089 19.9015C39.1374 15.8983 38.0956 11.4522 35.6101 8.32685C35.3148 7.9577 35.2327 7.90028 34.9866 7.90028C34.6257 7.90028 34.3714 8.13817 34.3714 8.4827C34.3714 8.65497 34.4862 8.88466 34.7323 9.19637C36.6108 11.6491 37.587 14.9714 37.3245 18.0475C37.1194 20.4429 36.4058 22.4772 35.0851 24.4296C34.3796 25.4714 32.7472 27.0792 31.6972 27.7765C29.7941 29.0397 27.6038 29.7862 25.389 29.9339C24.2569 30.0077 23.8714 30.2374 23.8714 30.8444C23.8714 30.9921 23.8468 31.1151 23.814 31.1151C23.7401 31.1151 21.2956 29.0808 21.2628 28.9905C21.2382 28.9249 23.5515 26.9561 23.7483 26.8823C23.8386 26.8413 23.8714 26.8905 23.8714 27.0464C23.8714 27.3663 24.0683 27.7026 24.3226 27.8175C24.8148 28.0472 26.5046 27.8503 27.8499 27.4073C29.4577 26.8823 30.8523 26.021 32.1237 24.7577C33.7151 23.1745 34.7241 21.2796 35.1671 19.0565C35.3394 18.187 35.3558 16.0788 35.1999 15.2011C34.3878 10.6401 30.7866 7.07177 26.2585 6.30888C25.3315 6.15302 23.5023 6.14481 22.6819 6.30067Z" fill="black" />
                        <path d="M23.494 10.1968C19.9584 10.6972 17.3498 13.8636 17.5795 17.3745C17.6943 19.0234 18.2686 20.3687 19.3924 21.5745C20.3275 22.5835 21.2545 23.1577 22.5178 23.5269C26.2174 24.5933 30.0072 22.3948 31.0162 18.605C31.2541 17.7026 31.2541 16.2425 31.0162 15.3237C30.8357 14.6183 30.2287 13.3058 29.9416 13.0105C29.6873 12.7316 29.392 12.6905 29.1377 12.8792C28.8014 13.1335 28.8096 13.4698 29.1623 14.0358C29.8022 15.0776 30.1057 16.4804 29.9416 17.678C29.7611 18.9741 29.2689 19.9749 28.342 20.9019C26.5947 22.6491 24.142 23.0511 21.9025 21.9519C21.2709 21.6401 21.0084 21.4515 20.4588 20.9101C18.7033 19.1546 18.3096 16.7265 19.417 14.4624C20.2783 12.6905 21.9928 11.5585 24.06 11.3862C24.79 11.3206 25.7826 11.4929 26.5045 11.7964C27.251 12.1163 27.5791 12.1491 27.8006 11.9112C28.0303 11.6569 28.0221 11.3042 27.776 11.0745C27.1115 10.4675 24.8557 9.99991 23.494 10.1968Z"fill="black" />
                        <path d="M24.0026 12.4367C23.8221 12.6172 23.7893 12.7238 23.7893 13.134C23.7893 13.6016 23.7729 13.6262 23.5432 13.7246C23.2069 13.8641 22.7311 14.348 22.5506 14.7418C22.3537 15.1848 22.3455 15.9559 22.5506 16.3906C22.8295 17.0223 23.6662 17.5801 24.3061 17.5801C24.7983 17.5801 25.1838 17.9574 25.1838 18.4332C25.1838 18.5398 25.0854 18.7449 24.9705 18.8844C24.7983 19.0977 24.6998 19.1387 24.4045 19.1387C23.978 19.1387 23.6252 18.8352 23.6252 18.466C23.6252 18.1871 23.2315 17.7441 22.9854 17.7441C22.8951 17.7441 22.7229 17.8262 22.5998 17.9246C22.3947 18.0887 22.3783 18.1379 22.4112 18.5727C22.4604 19.2207 22.7967 19.7539 23.3545 20.082L23.7811 20.3281L23.7893 20.8039C23.7893 21.1977 23.8221 21.3125 23.9944 21.4766C24.101 21.5914 24.2897 21.6816 24.4045 21.6816C24.5194 21.6816 24.708 21.5914 24.8147 21.4766C24.9869 21.3125 25.0197 21.1977 25.0197 20.7957C25.0197 20.3363 25.0362 20.3035 25.2576 20.2051C25.9549 19.918 26.4717 18.9992 26.3897 18.1953C26.283 17.1699 25.6104 16.5137 24.5194 16.3578C24.1174 16.3086 23.9615 16.243 23.8139 16.0707C23.3791 15.5621 23.7237 14.791 24.3881 14.791C24.7983 14.791 25.1838 15.1438 25.1838 15.5293C25.1838 15.841 25.5037 16.1855 25.799 16.1855C26.0944 16.1855 26.4143 15.841 26.4143 15.5211C26.4143 14.8648 25.8401 13.9625 25.274 13.7328C25.0526 13.6344 25.0362 13.5934 25.0033 13.1012C24.9705 12.5188 24.8639 12.3629 24.4701 12.2809C24.2569 12.2398 24.1666 12.2727 24.0026 12.4367Z" fill="black" />
                        <path d="M3.84748 31.8779C3.42092 32.165 3.34709 32.4931 3.3799 34.0517C3.40451 35.3478 3.41271 35.397 3.60139 35.5529C3.84748 35.758 4.22482 35.7497 4.4299 35.5447C4.57756 35.397 4.59396 35.274 4.59396 34.1501V32.9197L8.67912 32.9361L12.7561 32.9607V38.2927V43.6247L8.67912 43.6494L4.59396 43.6658V40.8521V38.0302L4.40529 37.858C4.05256 37.5298 3.52756 37.7021 3.40451 38.1861C3.3799 38.2927 3.36349 39.6872 3.3799 41.2869C3.40451 44.1744 3.40451 44.199 3.59318 44.4615C3.70803 44.6255 3.9049 44.765 4.08537 44.8142C4.29045 44.8798 5.79982 44.8962 8.74474 44.8798L13.1006 44.8552L13.4041 44.6173C13.8471 44.281 14.0276 43.8462 14.0276 43.0751V42.4353L23.9369 42.4189C34.9537 42.3861 34.1662 42.4353 34.8635 41.8037C35.5361 41.2048 35.7822 40.2943 35.5115 39.4083C35.3721 38.9572 34.8061 38.3173 34.3057 38.0712C33.9283 37.8908 33.8545 37.8826 31.1885 37.858C28.6537 37.8333 28.4569 37.8169 28.5061 37.6939C28.6209 37.4232 28.6455 36.6849 28.5553 36.3404C28.3912 35.7744 27.9647 35.2658 27.4315 35.0033C26.9557 34.7736 26.9475 34.7736 24.8639 34.7244L22.7639 34.6751L21.2053 34.0763C20.3522 33.7482 19.3678 33.4283 19.0315 33.3626C18.6213 33.2888 17.6944 33.256 16.226 33.2478H14.0276V33.0427C14.0276 32.5587 13.5928 31.9599 13.1006 31.7794C12.9447 31.722 11.3862 31.6892 8.49865 31.6892H4.12639L3.84748 31.8779ZM18.8838 34.5931C19.2119 34.6587 19.9584 34.8966 20.5326 35.1263C22.5588 35.9302 22.3619 35.8892 24.6506 35.9466C26.8162 36.004 26.9147 36.0205 27.2264 36.4142C27.5053 36.7669 27.4561 37.2263 27.1197 37.5626L26.8408 37.8415H24.7901C22.7475 37.8415 22.7311 37.8415 22.5096 38.0302C22.2225 38.2845 22.1979 38.7029 22.4686 38.9244C22.649 39.0638 22.9361 39.072 28.0631 39.072C32.4764 39.072 33.5264 39.0966 33.7479 39.1869C34.642 39.556 34.5764 40.8603 33.6494 41.1228C33.4526 41.172 30.0236 41.2048 23.6908 41.2048H14.0276V37.8415V34.4783H16.1522C17.6615 34.4783 18.449 34.5111 18.8838 34.5931Z" fill="black" />
                    </g>
                    <defs>
                        <clipPath id="clip0_5647_3180">
                            <rect width="42" height="42" fill="white" transform="translate(0 2.89648)" />
                        </clipPath>
                    </defs>
                </svg>
                <p class="lg:mt-9 mt-5 dm-sans font-medium lg:text-xl text-base text-gray-12">{{ __('My Refund') }}
                    <br> {{ __('Wallet') }}
                </p>
            </div>
            <div class="lg:mr-6 mr-4 lg:mt-9 mt-6 mb-6">
                <p class="dm-sans font-medium lg:text-base text-xs text-gray-12 text-right">{{ __('Current Amount') }}</p>
                <p class="lg:mt-7p dm-bold font-bold lg:text-2xl text-lg text-gray-12 text-right">{{ formatNumber(auth()->user()->refundBalance()) }}</p>
            </div>
        </div>
        <div class="xl:hidden block">
            <p class="text-gray-12 text-sm text-center mt-7 dm-sans font-medium">Want a Refund? Click the button below</p>
            <div class="bg-yellow-1 py-3.5 px-9  rounded dm-sans text-sm flex justify-center mx-16 items-center mt-15p ">
                <a href="{{ url('/user/create-refund-request') }}">{{ __('Request A Refund') }}</a>
            </div>
        </div>
        <div>
            <div class="lg:flex lg:justify-between lg:mt-7 mt-5">
                <div class="mt-14 lg:block hidden dm-bold font-bold text-gray-12 text-2xl uppercase">
                    <p>{{ __('refund list') }}</p>
                </div>
                <div class="text-lg mt-30p lg:hidden block dm-bold font-bold text-gray-12 lg:text-2xl uppercase">
                    <p>{{ __('refund list') }}</p>
                </div>
                <div class="flex justify-between lg:mt-10 mt-15p">
                    <h1 class="dm-sans font-medium mt-2 lg:text-lg text-sm whitespace-nowrap text-gray-12 mr-15p">
                        {{ __('Filter By') }}
                    </h1>
                    <div class="flex">
                        <div x-data="{ dropdownOpen: false }">
                            <div class="flex items-center">
                                <button @click="dropdownOpen = !dropdownOpen"
                                    class="inline-flex justify-between lg:w-168p w-24 border border-gray-2 px-2 lg:py-2.5 py-1 bg-white text-sm font-medium text-gray-10 hover:bg-gray-11">
                                    <div class="roboto-medium font-medium text-gray-10 lg:text-base text-xss whitespace-nowrap dark:text-gray-2">
                                        @if (isset(request()->filter_status))
                                            <span>{{ request()->filter_status }}</span>
                                        @else
                                            <span>{{ __('All Status') }}</span>
                                        @endif
                                    </div>
                                    <span class="mt-2 hidden lg:block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7"
                                            fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.89383e-08 1.21895L1.37054 1.63436e-08L6.5 4.5621L11.6295 1.3868e-07L13 1.21895L6.5 7L6.89383e-08 1.21895Z" fill="#898989" />
                                        </svg>
                                    </span>
                                    <span class=" mt-2 lg:hidden block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="4" viewBox="0 0 8 4" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.843412 1.00576e-08L4 2.60691L7.15659 8.53415e-08L8 0.696543L4 4L3.93933e-08 0.696543Z" fill="#898989" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
                            </div>
                            <div x-show="dropdownOpen" class="absolute lg:w-168p w-24 border-t-0 border-gray-2 border bg-white z-20">
                                <div>
                                    @php
                                        $statuses = ['Opened' => __('Opened'), 'In progress' => __('In progress'), 'Accepted' => __('Accepted'), 'Declined' => __('Declined'), 'All Status' => __('All Status')];
                                    @endphp

                                    @foreach ($statuses as $key => $status)
                                    <a href="{{ request()->fullUrlWithQuery(['filter_status' => $status]) }}" class="block whitespace-nowrap pt-3.5 lg:w-168p w-24  lg:text-sm text-xss roboto-medium text-gray-10 font-medium  border-t-0 capitalize lg:h-47p hover:bg-gray-11 hover:text-gray-12">
                                        @if (request('filter_status') == $status || (request('filter_status') == null && $key == 'All Status'))
                                            <span class="text-green-1 ml-2 text-md">✓</span><span
                                                class="inline-block lg:ml-3 ml-1 text-green-1 mb-2">{{ $status }}</span>
                                        @else
                                            <span class="inline-block lg:ml-6 ml-2 mb-2">{{ $status }}</span>
                                        @endif
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div x-data="{ dropdownOpen: false }">
                            <div class="flex items-center ml-3">
                                <button @click="dropdownOpen = !dropdownOpen" class="inline-flex justify-between lg:w-168p w-24 rounded-sm border border-gray-2 px-2 lg:py-2.5 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none dark:bg-gray-2">
                                    <div class="roboto-medium font-medium text-gray-10 lg:text-base text-xss whitespace-nowrap dark:text-gray-2">
                                        @if (isset(request()->filter_day))
                                            <span>{{ ucwords(str_replace('_', ' ', request()->filter_day)) }}</span>
                                        @else
                                            <span>{{ __('All') }}</span>
                                        @endif
                                    </div>
                                    <span class="mt-2 hidden lg:block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.89383e-08 1.21895L1.37054 1.63436e-08L6.5 4.5621L11.6295 1.3868e-07L13 1.21895L6.5 7L6.89383e-08 1.21895Z" fill="#898989" />
                                        </svg>
                                    </span>
                                    <span class=" mt-2 lg:hidden block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="4" viewBox="0 0 8 4" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.843412 1.00576e-08L4 2.60691L7.15659 8.53415e-08L8 0.696543L4 4L3.93933e-08 0.696543Z" fill="#898989" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
                            </div>
                            <div x-show="dropdownOpen"class="absolute lg:w-168p w-24 ml-3 border-t-0 border-gray-2 border bg-white z-20">
                                <div>
                                    @php
                                        $statuses = ['today' => __('Today'), 'last_week' => __('Last Week'), 'last_month' => __('Last Month'), 'last_year' => __('Last Year'), 'all' => __('All')];
                                    @endphp

                                    @foreach ($statuses as $key => $status)
                                    <a href="{{ request()->fullUrlWithQuery(['filter_day' => $key]) }}" class="block whitespace-nowrap pt-3.5 lg:w-168p w-24  lg:text-sm text-xss roboto-medium text-gray-10 font-medium  border-t-0 capitalize lg:h-47p hover:bg-gray-11 hover:text-gray-12">
                                        @if (request('filter_day') == $key || (request('filter_day') == null && $key == 'all'))
                                            <span class="text-green-1 ml-2 text-md">✓</span><span
                                                class="inline-block lg:ml-3 ml-1 text-green-1 mb-2">{{ $status }}</span>
                                        @else
                                            <span class="inline-block lg:ml-6 ml-2 mb-2">{{ $status }}</span>
                                        @endif
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:max-w-8xl md:mx-auto lg:py-23p py-0">
            <div class="overflow-x-auto hidden lg:block rounded-sm">
                <table class="w-full whitespace-no-wrap bg-white dark:bg-gray-2 overflow-hidden table-striped">
                    <thead>
                        <tr class="text-left bg-gray-11 border border-gray-2 rounded-t dark:bg-gray-2 text-gray-500 font-thin text-xs">
                            <th class="pl-10 pr-14 py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2 tracking-wider">
                                {{ __('ID Number') }}
                            </th>
                            <th class="px-6 py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2 tracking-wider">
                                {{ __('Date') }}
                            </th>
                            <th class="pl-10 py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2 tracking-wider">
                                {{ __('Amount') }}
                            </th>
                            <th class="pl-72p py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2 tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th class="px-6 py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                {{ __('View') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($refunds) > 0)
                            @foreach ($refunds as $refund)
                                <tr class="focus-within:bg-gray-200 overflow-hidden border border-gray-2">
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <span class="roboto-medium font-medium text-gray-10 pl-10 py-4 flex items-center dark:text-gray-2">{{ $refund->orderDetail->order->reference }}</span>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <span class="roboto-medium font-medium text-gray-10 px-6 py-18p flex items-center dark:text-gray-2">
                                            {{ timezoneFormatDate($refund->created_at) }}
                                        </span>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3 pl-4">
                                        <span class="roboto-medium font-medium text-gray-10 px-6 py-4 flex items-center dark:text-gray-2">
                                            {{ $refund->quantity_sent . ' x ' . formatNumber($refund->orderDetail->price) }}</span>
                                    </td>
                                    <td class="border-t dark:border-t-gray-2 dark:bg-gray-3">
                                        <span class="roboto-medium font-medium text-base ml-68p py-4 flex items-center dark:text-gray-2">
                                            @php
                                                $color = ['Opened' => 'bg-gray-11 ; text-gray-10 ', 'In progress' => 'bg-green-2 ; text-green-1', 'Accepted' => 'bg-green-2 ; text-green-1', 'Declined' => 'bg-pinks-2 ; text-reds-3'];
                                            @endphp
                                            <span
                                                class="{{ $color[$refund->status] }} py-2 px-9 rounded text-xs">
                                                {{ $refund->status }}
                                            </span>
                                        </span>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3 pl-6">
                                        <div>
                                            <a href="{{ route('site.refundDetails', $refund->id) }}">
                                                <button class="px-1 py-1 rounded font-medium">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 5C4 4.44772 4.44772 4 5 4L9 4C9.55228 4 10 4.44772 10 5C10 5.55229 9.55228 6 9 6L5 6C4.44772 6 4 5.55228 4 5Z" fill="#828282" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 13C4 12.4477 4.44772 12 5 12L8 12C8.55228 12 9 12.4477 9 13C9 13.5523 8.55228 14 8 14L5 14C4.44772 14 4 13.5523 4 13Z" fill="#828282" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 9C4 8.44772 4.44772 8 5 8L11 8C11.5523 8 12 8.44772 12 9C12 9.55229 11.5523 10 11 10L5 10C4.44772 10 4 9.55228 4 9Z" fill="#828282" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.92943 20L8 20V18H7C5.55752 18 4.57625 17.9979 3.84143 17.8991C3.13538 17.8042 2.80836 17.6368 2.58579 17.4142C2.36322 17.1916 2.19585 16.8646 2.10092 16.1586C2.00213 15.4237 2 14.4425 2 13V7C2 5.55751 2.00213 4.57625 2.10092 3.84143C2.19585 3.13538 2.36322 2.80836 2.58579 2.58578C2.80836 2.36321 3.13538 2.19584 3.84143 2.10092C4.57625 2.00212 5.55752 2 7 2H9C10.4425 2 11.4238 2.00212 12.1586 2.10092C12.8646 2.19584 13.1916 2.36321 13.4142 2.58578C13.6368 2.80836 13.8042 3.13538 13.8991 3.84143C13.9979 4.57625 14 5.55751 14 7V9H16L16 6.92942C16 5.5753 16.0001 4.45869 15.8813 3.57493C15.7565 2.6471 15.4845 1.82768 14.8284 1.17157C14.1723 0.515463 13.3529 0.243494 12.4251 0.11875C11.5413 -6.86646e-05 10.4247 -3.8147e-05 9.07055 -1.90735e-06H6.92946C5.57533 -3.8147e-05 4.4587 -6.86646e-05 3.57494 0.11875C2.64711 0.243494 1.82768 0.515463 1.17158 1.17157C0.515467 1.82768 0.243498 2.6471 0.118755 3.57493C-6.35162e-05 4.45869 -3.41884e-05 5.57531 1.21679e-06 6.92943V13.0706C-3.41884e-05 14.4247 -6.35162e-05 15.5413 0.118755 16.4251C0.243498 17.3529 0.515467 18.1723 1.17158 18.8284C1.82768 19.4845 2.64711 19.7565 3.57494 19.8812C4.4587 20.0001 5.57531 20 6.92943 20Z" fill="#828282" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 14C12.6716 14 12 14.6716 12 15.5C12 16.3284 12.6716 17 13.5 17C14.3284 17 15 16.3284 15 15.5C15 14.6716 14.3284 14 13.5 14ZM10 15.5C10 13.567 11.567 12 13.5 12C15.433 12 17 13.567 17 15.5C17 17.433 15.433 19 13.5 19C11.567 19 10 17.433 10 15.5Z" fill="#828282" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7929 16.7929C15.1834 16.4024 15.8166 16.4024 16.2071 16.7929L17.7071 18.2929C18.0976 18.6834 18.0976 19.3166 17.7071 19.7071C17.3166 20.0976 16.6834 20.0976 16.2929 19.7071L14.7929 18.2071C14.4024 17.8166 14.4024 17.1834 14.7929 16.7929Z" fill="#828282" />
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="h-197 border rounded-b">
                                <td colspan="5">
                                    <p class="text-center dm-sans -mt-12 font-medium text-xl text-gray-10">
                                        {{ __('You Have No Refund Requests Yet') }} </p>
                                    <div class="w-full text-center mt-9">
                                        <a class="hover:bg-yellow-1 hover:border-white delay-120 hover:text-gray-12 border-gray-12 border py-3.5 px-9 w-190 h-12 rounded dm-sans text-sm" href="{{ url('/user/create-refund-request') }}">Request A Refund</a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <div class="block mt-5 lg:hidden">
                @if (count($refunds) > 0)
                    @foreach ($refunds as $refund)
                        <a href="" class="flex cursor-pointer justify-between p-15p border-t border border-gray-2">
                            <div>
                                <p class="capitalized text-gray-10 text-xs roboto-medium font-medium mb-1.5">
                                    {{ __('Refund ID') }}
                                </p>
                                <p class="roboto-medium text-xl font-medium text-gray-12 mb-1.5">
                                     {{ $refund->orderDetail->order->reference }}</p>
                                <p class="roboto-medium font-medium text-gray-10 text-xs">
                                    {{ timezoneFormatDate($refund->created_at) }}</p>
                            </div>
                            <div>
                                <p class="roboto-medium font-medium mb-3 text-gray-10 text-right">
                                    @php
                                        $color = ['Opened' => 'bg-gray-11 ; text-gray-10 ', 'In progress' => 'bg-green-2 ; text-green-1', 'Accepted' => 'bg-green-2 ; text-green-1', 'Declined' => 'bg-pinks-2 ; text-reds-3'];
                                    @endphp
                                    <span class="{{ $color[$refund->status] }} px-7 py-1.5 text-center rounded text-xs">
                                        {{ $refund->status }}
                                    </span>
                                </p>
                                <p class="roboto-medium font-medium text-gray-12 text-xl text-right dark:text-gray-2">
                                    {{ formatNumber($refund->orderDetail->price) }}</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="dm-sans font-medium text-gray-10 text-lg cursor-pointer text-center py-10  border-t border border-gray-2">{{ __('You Have No Refund Requests Yet.') }}</p>
                @endif
            </div>
        </div>
        {{ $refunds->onEachSide(1)->links('site.layouts.partials.pagination') }}
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/dist/js/custom/site/common.min.js') }}"></script>
@endsection
