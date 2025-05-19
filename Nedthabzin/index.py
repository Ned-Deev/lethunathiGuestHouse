import zipfile
import os

# Create directory structure
base_dir = "lethunathi_contact_package"
phpmailer_dir = os.path.join(base_dir, "phpmailer/src")
os.makedirs(phpmailer_dir, exist_ok=True)

# Sample files to include (demo placeholders, actual PHPMailer files should be added in real scenario)
files_to_create = {
    os.path.join(base_dir, "contact_sendgrid.php"): "<?php\n// SendGrid integration code here\n?>",
    os.path.join(base_dir, "contact_cpanel.php"): "<?php\n// cPanel SMTP integration code here\n?>",
    os.path.join(base_dir, "index.html"): """
<!DOCTYPE html>
<html>
  <body>
    <form action='contact_sendgrid.php' method='POST'>
      <input name='name' placeholder='Your Name'>
      <input name='email' placeholder='Your Email'>
      <textarea name='message' placeholder='Your Message'></textarea>
      <button type='submit'>Send</button>
    </form>
  </body>
</html>
""",
    os.path.join(phpmailer_dir, "PHPMailer.php"): "<?php\n// PHPMailer class stub\n?>",
    os.path.join(phpmailer_dir, "SMTP.php"): "<?php\n// SMTP class stub\n?>",
    os.path.join(phpmailer_dir, "Exception.php"): "<?php\n// Exception class stub\n?>"
}

# Write files
for path, content in files_to_create.items():
    with open(path, "w") as f:
        f.write(content)

# Create ZIP
zip_filename = "lethunathi_contact_package.zip"
with zipfile.ZipFile(zip_filename, "w") as zipf:
    for foldername, _, filenames in os.walk(base_dir):
        for filename in filenames:
            file_path = os.path.join(foldername, filename)
            arcname = os.path.relpath(file_path, base_dir)
            zipf.write(file_path, arcname)

print(f"ZIP file created: {zip_filename}")
