Vagrant::Config.run do |config|
    config.vm.box = "symfony"
    config.vm.box_url = "http://vagrant.rithis.com/symfony.box"
    config.vm.network :hostonly, "192.168.33.10"
    config.vm.share_folder("v-root", "/vagrant", ".", :nfs => true)
end
