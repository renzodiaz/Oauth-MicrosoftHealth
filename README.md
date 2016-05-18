# Microsoft Health
This is a custom class for retrieve data was created using the Microsoft Health Cloud API Guide.
https://developer.microsoftband.com/Content/docs/MS%20Health%20API%20Getting%20Started.pdf

<h2>REQUIREMENTS</h2>
This class requieres at least <strong>PHP 5.2</strong> and <strong>CURL (with SSL) extension</strong>.

<h2>INSTALLATION</h2>
Simply include the class and you are good to go. Check a example <strong>index.php</strong>

<h2>METHODS</h2>

<h3>requestAccessCode()</h3>
Log into Microsoft Health for accept the application and it returns acces code.
<h3>getAccessToken()</h3>
Returns the access_token.
<h3>request()</h3>
Get protected resources from Microsoft Health Cloud.
<hr/>
<h2>The MIT License (MIT)</h2>

Copyright (c) 2016 Renzo Diaz dev.renzo.diaz@gmail.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.



